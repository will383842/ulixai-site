<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function affliateSignup(Request $request)
    {
        if ($request->query('code')) {
            return view('user-auth.signup');
        } else {
            return redirect()->route('login')->with('error', 'Affiliate code is missing.');
        }
    }
}
