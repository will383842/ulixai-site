<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UlixCommission;

class ServiceFeesController extends Controller
{
    public function index()
    {
        $commission = UlixCommission::first();

        return view('admin.dashboard.manage-fees.index', compact('commission'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requester_fee' => 'required|numeric|between:0,100',
            'provider_fee' => 'required|numeric|between:0,100',
            'affiliate_fee' => 'required|numeric|between:0,100',
            'description' => 'nullable|string'
        ]);

        UlixCommission::create($validated);

        return redirect()->back()->with('success', 'Commission rates created successfully');
    }

    public function update(Request $request, UlixCommission $serviceFee)
    {
        $validated = $request->validate([
            'requester_fee' => 'required|numeric|between:0,100',
            'provider_fee' => 'required|numeric|between:0,100',
            'affiliate_fee' => 'required|numeric|between:0,100',
            'description' => 'nullable|string'
        ]);

        $serviceFee->update($validated);

        return redirect()->back()->with('success', 'Commission rates updated successfully');
    }
}
