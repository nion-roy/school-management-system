<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Teacher;
use App\Models\TeacherTab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
	public function allTeachers(string $id)
	{
		$teacherType = TeacherTab::findOrFail($id);
		$teachers = Teacher::where('status', true)->latest()->get();
		return view('teacher', compact('teachers', 'teacherType'));
	}

	// public function teacherTab($slug)
	// {
	// 	$teacher = Teacher::where('status', true)->where('slug', $slug)->latest()->get();
	// 	$tabs = TeacherTab::latest()->get();
	// 	return view('teacher', compact('teacher', 'tabs'));
	// }
}
