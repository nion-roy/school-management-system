<?php

namespace App\Http\Controllers;

use App\Models\OldStudent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
	public function student()
	{
		$students = OldStudent::where('status', true)->where('student_type', 'Achievement Student')->latest()->paginate(12);
		return view('student', compact('students'));
	}
}
