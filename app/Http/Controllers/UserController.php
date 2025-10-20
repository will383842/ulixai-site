<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function storeViaSignup(Request $request)
    {
        $data = $request->all();

        // validate required (minimum first impl): fname, email
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'f_name' => 'required|string|max:100',
        ]);

        // Fill any fields you wish from collected front
        $user = new User;
        $user->f_name = $data['f_name'] ?? '';
        $user->l_name = $data['l_name'] ?? null;
        $user->email = $data['email'];
        $user->n_language = $data['native_language'] ?? 'en';
        $user->spoken_languages = ($data['spoken_languages'] ?? null) ? json_encode($data['spoken_languages']) : null;
        $user->service_to_offer = is_array($data['service_to_offer'] ?? null) ? implode(', ', $data['service_to_offer']) : ($data['service_to_offer'] ?? null);
        $user->operational_countries = $data['operational_countries'] ?? null;
        $user->profile_description = $data['profile_description'] ?? null;
        $user->profile_photo = null; // Handle upload separately, for now null
        $user->user_role = 'service_provider';
        $user->communicate_online = (bool)($data['communicate_online'] ?? false);
        $user->communicate_in_person = (bool)($data['communicate_in_person'] ?? false);

        // Default init
        $user->country_code = 'FR';
        $user->affiliate_code = User::generateAffiliateCode();

        // Optional populate: (further scopes!)
        // $user->country = ...;
        // $user->status etc...

        $user->save();

        return response()->json(['status' => 'success', 'id' => $user->id]);
    }
}
