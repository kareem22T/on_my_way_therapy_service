<?php


namespace App\Http\Controllers;

use App\Models\Therapist_rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        $theRate = Therapist_rating::where('client_id', Auth::guard('client')->user()->id);

        if ($theRate) {
            $theRate->rating = $request->rating;
            $theRate->review = $request->review;
            $theRate->doctor_id = $request->doctor_id;
            $theRate->save();
        } else {
            Therapist_rating::create([
                'rating' => $request->rating,
                'review' => $request->review,
                'doctor_id' => $request->doctor_id,
                'client_id' => Auth::guard('client')->user()->id
            ]);
        }

        return response()->json([
            'status' => 200,
        ])
    }
}