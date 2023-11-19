<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\QRCode;
use App\Models\TrackQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TrackQRController extends Controller
{
    function qr(Campaign $campaign, QRCode $qrcode)
    {
         return Redirect::away($qrcode->destination_url);
    }
}
