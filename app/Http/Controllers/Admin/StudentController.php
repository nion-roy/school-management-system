<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$students = Student::latest()->get();
		return view('admin.students.index', compact('students'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		// $serialNumber = Student::where('roll', 'asc')->max('roll') + 1;
		// $serialNumber = Student::orderBy('id', 'desc')->first()->roll + 1;
		$register = 'XMA-' . date('Ymd-') . str_pad(rand(0, 999) + 0, 3, 0, STR_PAD_LEFT);
		$batches = Batch::get();
		$students = User::where('role', 'user')->where('status', true)->latest()->get();
		return view('admin.students.create', compact('register', 'batches', 'students'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{

		$this->validate($request, [
			'student_id'	=> 'required',
			'class_id'	=> 'required',
			'session'	=> 'required',
			'roll'	=> 'required',
			'register'	=> 'required',
		]);

		$student = new Student();
		$student->student_id = $request->student_id;
		$student->class_id = $request->class_id;
		$student->session = $request->session;
		$student->roll = $request->roll;
		$student->register = $request->register;

		$student->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$batches = Batch::latest()->get();
		$students = User::where('role', 'user')->where('status', true)->latest()->get();
		$student = Student::findOrFail($id);
		return view('admin.students.edit', compact('student', 'batches', 'students'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'class_id'		=> 'required',
			'student_id'		=> 'required',
			'roll'		=> 'required',
			'register'		=> 'required',
			'session'		=> 'required',
		]);


		$students = Student::findOrFail($id);
		$students->student_id = $request->student_id;
		$students->class_id = $request->class_id;
		$students->roll = $request->roll;
		$students->register = $request->register;
		$students->session = $request->session;

		$students->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Student::findOrFail($id)->delete();
		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}
}
