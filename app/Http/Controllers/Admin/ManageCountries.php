<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class ManageCountries extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $countries = Country::where(function($query) use ($search) {
            if ($search) {
                $query->where('country', 'like', "%{$search}%")
                    ->orWhere('short_name', 'like', "%{$search}%");
            }
        })
        ->orderBy('country')
        ->paginate(50)
        ->withQueryString();

        return view('admin.dashboard.country.index', compact('countries', 'search'));
    }

    public function toggleStatus(Request $request, Country $country)
    {
        $country->update([
            'status' => !$country->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Country status updated successfully',
            'status' => $country->status
        ]);
    }
}
