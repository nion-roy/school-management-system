<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Slider;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\OldStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
	public function index()
	{
		// $departments = Batch::count();
		// $subjects = Subject::count();
		// $students = Student::count();
		// $achievement = OldStudent::where('student_type', 'Achievement Student')->count();
		// $former = OldStudent::where('student_type', 'Former Student')->count();
		// $teachers = Teacher::count();
		// $sliders = Slider::count();
		// $notices = Notice::latest()->get()->take(5);
		// compact('departments', 'subjects', 'students', 'teachers', 'sliders', 'notices')
		return view('admin.dashboard');
	}

	/**
	 * Destroy an authenticated session.
	 */
	public function destroy(Request $request): RedirectResponse
	{
		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		Alert::success('Success', 'Admin Logout Successfully');
		return redirect()->route('admin.login');
	}
}
