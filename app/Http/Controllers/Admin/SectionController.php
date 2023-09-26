<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SectionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$sections = Section::latest()->get();
		return view('admin.section.index', compact('sections'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.section.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'section' => 'required',
		]);

		$section = new Section();
		$section->section = $request->section;

		$section->save();
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
		$section = Section::findOrFail($id);
		return view('admin.section.edit', compact('section'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'section' => 'required',
		]);
		
		$section = Section::findOrFail($id);
		$section->section = $request->section;

		if (isset($request->status)) {
			$section->status = true;
		} else {
			$section->status = false;
		}

		$section->update();
		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Section::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
