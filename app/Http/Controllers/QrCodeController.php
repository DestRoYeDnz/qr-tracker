<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

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
        ->header('Content-Type','image/svg+xml');
    }

    function create()
    {
        return view('qrcode.create');
    }

    function filterString($inputString) {
        $pattern = '/[^1234567890\-abcdefghijklmnopqrstuvwxyz]/';
        $filteredString = preg_replace($pattern, '', $inputString);    
        return $filteredString;
    }
}
