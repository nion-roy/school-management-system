<?php

namespace App\Http\Controllers;

use App\Models\Speech;
use Illuminate\Http\Request;

class SpeechController extends Controller
{
    /**
     * Speech the specified resource from storage.
     */
    public function speech($slug)
    {
        $speech = Speech::where('slug', $slug)->first();
        return view('speech', compact('speech'));
    }
}
