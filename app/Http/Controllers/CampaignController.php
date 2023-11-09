<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    function index()
    {
        return view('campaign.index');
    }
}
