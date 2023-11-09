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
            $id
        );

        return response($data)
        ->header('Content-type', 'image/svg')->header('Content-disposition', 'attachment; filename="image.svg"');
    }
}
