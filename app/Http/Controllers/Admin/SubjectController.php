<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SubjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$subject = Subject::latest()->get();
		return view('admin.subject.index', compact('subject'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.subject.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'subject' => 'required',
		]);

		$subject = new Subject();
		$subject->subject = $request->subject;

		if (isset($request->status)) {
			$subject->status = true;
		} else {
			$subject->status = false;
		}


		$subject->save();
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
		$subject = Subject::findOrFail($id);
		return view('admin.subject.edit', compact('subject'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'subject' => 'required',
		]);

		$subject = Subject::findOrFail($id);
		$subject->subject = $request->subject;

		if (isset($request->status)) {
			$subject->status = true;
		} else {
			$subject->status = false;
		}


		$subject->update();
		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Subject::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
