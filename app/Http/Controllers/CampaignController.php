<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\QRCode;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use App\Tables\Campaign as CampaignTable;

class CampaignController extends Controller
{
    function index()
    {
        return view('campaign.index',[
            'users' => CampaignTable::class
    
        ]);
    }
    function create()
    {
        return view('campaign.add');
    }

    function show(Campaign $campaign)
    {
        $qrcodes = QRCode::where('user_id', auth()->id())->get();
        return view('campaign.show', [
            'qrcodes' => $qrcodes,
            'campaign' => $campaign,

    
        ]);
    }
    function store(Request $request)
    {
        //return $request;
        $rules = [
            'campaign_name' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
        ];

        // Validate the request
        $request->validate($rules);

        // Create a new campaign
        $campaign = new Campaign();
        $campaign->user_id = auth()->id();
        $campaign->name = $request->input('campaign_name');
        $campaign->description = $request->input('description');
        $campaign->save();

        return redirect('/my-campaign/' . $campaign->id);
    }

}
