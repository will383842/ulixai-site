<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UlixaiReview;


class UlixaiReviewController extends Controller
{
    public function userReview(Request $request) 
    {
        $user = Auth::user();

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        try {
            UlixaiReview::create([
                'review_by' => $user->id,
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);
            return redirect()->route('user.service.requests')->with('success', 'Thank you for your review!');
        } catch (\Exception $e) {
            return redirect()->route('user.service.requests')->with('Error', $e-getMessage());
        }
    }
}
