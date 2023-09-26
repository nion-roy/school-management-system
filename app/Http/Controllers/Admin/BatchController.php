<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BatchController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$batches = Batch::latest()->get();
		return view('admin.batch.index', compact('batches'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$sections = Section::where('status', true)->get();
		return view('admin.batch.create', compact('sections'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'batch' => 'required',
		]);

		$class = new Batch();
		$class->section_id = $request->section_id;
		$class->batch = $request->batch;

		if (isset($request->status)) {
			$class->status = true;
		} else {
			$class->status = false;
		}

		$class->save();
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
		$class = Batch::findOrFail($id);
		$sections = Section::where('status', true)->get();
		return view('admin.batch.edit', compact('class', 'sections'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'batch' => 'required',
		]);

		$class = Batch::findOrFail($id);
		$class->section_id = $request->section_id;
		$class->batch = $request->batch;

		if (isset($request->status)) {
			$class->status = true;
		} else {
			$class->status = false;
		}

		$class->update();
		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Batch::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
