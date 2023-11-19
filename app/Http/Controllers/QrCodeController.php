<?php

namespace App\Http\Controllers;

use App\Models\QRCode as ModelsQRCode;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Components\Form\Textarea;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Password;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Textarea as FormBuilderTextarea;
use ProtoneMedia\Splade\FormBuilder\Radios;
use ProtoneMedia\Splade\SpladeForm;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class QrCodeController extends Controller
{
    public function show($id)
    {
        $data =  QrCode::size(400)
            ->backgroundColor(255, 255, 255)
            ->color(255, 0, 0)
            ->margin(1)
            ->generate(
                $this->filterString($id)
            );

        return response($data, 200)
            ->header('Content-Type', 'image/svg+xml');
    }

    function create($id)
    {
        $defaults['id'] = $id;
        $defaults['type'] = 'qrcode';

        $form = SpladeForm::make()
            ->action(route('qrcode.store'))
            ->fill($defaults)
            ->fields([
                Radios::make('type')
                    ->label('Choose a type')
                    ->options([
                        'qrcode' => 'QR Code',
                        'link' => 'Link',
                    ])->inline(),
                Input::make('id')->hidden()->required(),
                Input::make('name')->label('Name')->required(),
                FormBuilderTextarea::make('description')->label('Description'),
                Input::make('destination_url')->label('Destination URL')->required(),
                Input::make('grandfathered_url')->label('Gandfather URL'),
                Submit::make()->label('Create'),
            ]);

        return view('qrcode.create', [
            'form' => $form
        ]);
    }

    public function store(Request $request)
    {

        // Validation rules
        $rules = [
            'id' => 'uuid|required',
            'type' => 'in:qrcode,link|required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'destination_url' => 'required|url',
            'grandfathered_url' => 'nullable|url',
        ];

        // Custom error messages
        $messages = [
            'option.in' => 'The selected option is invalid.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Store the form data
        $qrCodeModel = new ModelsQRCode();
        $qrCodeModel->campaign_id = $request->input('id');
        $qrCodeModel->user_id = auth()->user()->id;
        $qrCodeModel->name = $request->input('name');
        $qrCodeModel->description = $request->input('description');
        $qrCodeModel->type = $request->input('type');
        $qrCodeModel->destination_url = $request->input('destination_url');
        $qrCodeModel->grandfather_url = $request->input('grandfathered_url');
        $qrCodeModel->save();

        $qrcode = new Generator;
        $data = 'http://10.1.1.40:8000/track/qr/' . $request->input('id') . '/' . $qrCodeModel->id ;
        $image = $qrcode->size(150)->format('png')->generate($data);
        file_put_contents('/home/brettj/projects/qr-tracker/storage/app/public/'.$request->input('id').'-'.$qrCodeModel->id . '.png', $image);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }


    function filterString($inputString)
    {
        $pattern = '/[^1234567890\-abcdefghijklmnopqrstuvwxyz]/';
        $filteredString = preg_replace($pattern, '', $inputString);
        return $filteredString;
    }
}
