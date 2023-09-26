<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Vision;
use Illuminate\Http\Request;

class AboutController extends Controller
{
	public function about()
	{
		$missions = Mission::where('status', true)->get()->first();
		$visions = Vision::where('status', true)->get()->first();
		return view('about', compact('missions', 'visions'));
	}
}
