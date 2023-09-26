<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\StudentResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStudent;
use Brian2694\Toastr\Facades\Toastr;

class StudentResultController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$results = StudentResult::latest()->get();
		return view('admin.students-result.index', compact('results'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$batches = Batch::get();
		$subjects = Subject::get();
		$student = User::where('status', true)->get();
		return view('admin.students-result.create', compact('batches', 'subjects', 'student'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{

		// return $request;

		$this->validate($request, [
			'class_id'		=> 'required',
			'user_id'		=> 'required',
			'subject_id'		=> 'required',
			'mark'		=> 'required',
		]);


		$results = new StudentResult();
		$results->class_id = $request->class_id;
		$results->subject_id = $request->subject_id;
		$results->user_id = $request->user_id;
		$results->student_roll = $request->student_roll;
		$results->mark = $request->mark;


		// return $request;

		$results->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$result = StudentResult::findOrFail($id);
		$allResults = StudentResult::get();
		$studentInfo = UserStudent::get()->first();
		return view('admin.students-result.show', compact('result', 'allResults', 'studentInfo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$result = StudentResult::findOrFail($id);
		$batches = Batch::get();
		$subjects = Subject::get();
		$student = Student::get();
		return view('admin.students-result.edit', compact('batches', 'subjects', 'student', 'result'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{

		$this->validate($request, [
			'class_id'		=> 'required',
			'user_id'		=> 'required',
			'subject_id'		=> 'required',
			'mark'		=> 'required',
		]);

		$results = StudentResult::findOrFail($id);
		$results->class_id = $request->class_id;
		$results->user_id = $request->user_id;
		$results->subject_id = $request->subject_id;
		$results->student_roll = $request->student_roll;
		$results->mark = $request->mark;


		$results->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		StudentResult::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}


	public function getRolls($id)
	{
		$roll = Student::where('class_id', $id)->get();
		return response()->json($roll);
	}

	public function getInformation($id)
	{

		$student = Student::where('id', $id)->with('student')->get();
		return $student;


		// $student = UserStudent::where('user_id', $id)->with('student');
		// return response()->json($student);
		// return $student;
	}
}
