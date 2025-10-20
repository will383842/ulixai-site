<?php

// app/Http/Controllers/RecruitApplicationController.php
namespace App\Http\Controllers;

use App\Models\RecruitApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Country;

class RecruitApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_title' => ['required','string','max:255'],
            'country'    => ['nullable','string','max:100'],
            'first_name' => ['nullable','string','max:100'],
            'last_name'  => ['nullable','string','max:100'],
            'phone'      => ['nullable','string','max:50'],
            'email'      => ['required','email','max:255'],
            'message'    => ['nullable','string','max:5000'],
            'cv'         => ['nullable','file','mimes:pdf,doc,docx,txt,jpg,jpeg,png','max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('cv')) {
            // store in storage/app/public/recruit-cv
            $path = $request->file('cv')->store('recruit-cv', 'public');
        }

        $app = RecruitApplication::create([
            'user_id'    => Auth::id(),
            'role_title' => $validated['role_title'],
            'country'    => $validated['country'] ?? null,
            'first_name' => $validated['first_name'] ?? (Auth::user()->name ?? null),
            'last_name'  => $validated['last_name'] ?? null,
            'phone'      => $validated['phone'] ?? null,
            'email'      => $validated['email'],
            'message'    => $validated['message'] ?? null,
            'cv_path'    => $path,
            'status'     => 'new',
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Application submitted.',
            'id' => $app->id,
        ]);
    }

   public function allcountry(Request $request){
    $allCountries = Country::get();
      return view('pages.recruitment' , compact('allCountries'));
   }

}

