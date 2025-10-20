<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartnershipRequest;

class PartnershipController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'language_spoken' => 'required|string|max:20', // Corrected 'langauge_spoken' to 'language_spoken'
        'partnership_type' => 'required|string|max:255', // Moved this line to the correct place
        'country' => 'required|string|max:100',
        'sector_of_activity' => 'nullable|string|max:255',
        'preferred_time' => 'nullable|string|max:255',
        'how_heard_about' => 'nullable|string|max:255',
        'motivation' => 'nullable|string|max:500',
    ]);

    // Store the data
    $partnership = new PartnershipRequest();
    $partnership->first_name = $request->input('first_name');
    $partnership->last_name = $request->input('last_name');
    $partnership->phone = $request->input('phone');
    $partnership->language_spoken = $request->input('language_spoken'); // Corrected field name
    $partnership->country = $request->input('country');
    $partnership->sector_of_activity = $request->input('sector_of_activity');
    $partnership->preferred_time = $request->input('preferred_time');
    $partnership->how_heard_about = $request->input('how_heard_about');
    $partnership->motivation = $request->input('motivation');
    $partnership->partnership_type = $request->input('partnership_type'); // Storing partnership_type
    $partnership->save();

    return response()->json(['success' => true, 'message' => 'Partnership Request Created Successfully.']);
}

}
