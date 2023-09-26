<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Academic;
use App\Models\Announcement;
use App\Models\Chairman;
use App\Models\Facts;
use App\Models\Gallery;
use App\Models\Notice;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Speech;
use App\Models\Teacher;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		// $randomTeacher = Teacher::inRandomOrder()->where('status', true)->limit(4)->get();
		$galleries = Gallery::where('status', true)->latest()->get()->take(6);
		$testimonials = Testimonial::where('status', true)->latest()->get();
		// $partners = Partner::where('status', true)->latest()->get();
		$announcement = Announcement::where('status', true)->latest()->get();
		$notice = Notice::where('status', true)->latest()->get()->take(4);
		$academicInfo = Academic::where('status', true)->latest()->get();
		return view('welcome', compact('galleries', 'testimonials', 'announcement', 'notice', 'academicInfo'));
	}
}
