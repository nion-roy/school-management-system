<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\TeacherAssign;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Section;
use Brian2694\Toastr\Facades\Toastr;

class TeacherAssignController extends Controller
{
	public function index()
	{
		$assignTeachers = TeacherAssign::get();
		$subjects = Subject::get();
		$classes = Batch::get();
		$sections = Section::get();
		$teachers = User::where('role', 'teacher')->latest()->get();
		return view('admin.teacher.index', compact('assignTeachers', 'classes', 'subjects', 'teachers', 'sections'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'section_id' => 'required',
			'subject_id' => 'required',
			'teacher_id' => 'required',
			'class_id'	 => 'required',
		], [
			'section_id' => 'The section field is required.',
			'subject_id' => 'The subject field is required.',
			'teacher_id' => 'The teacher field is required.',
			'class_id' 	 => 'The class field is required.',
		]);

		$teacherAssign = new TeacherAssign();
		$teacherAssign->section_id = $request->section_id;
		$teacherAssign->class_id = $request->class_id;
		$teacherAssign->subject_id = $request->subject_id;
		$teacherAssign->teacher_id = $request->teacher_id;

		$teacherAssign->save();
		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}


	public function destroy(string $id)
	{
		TeacherAssign::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
