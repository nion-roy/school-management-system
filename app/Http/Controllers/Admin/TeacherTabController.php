<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeacherTab;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TeacherTabController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tabs = TeacherTab::latest()->get();
		return view('admin.teacher.teacher-info.index', compact('tabs'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|string'
		]);

		$tab = new TeacherTab();
		$tab->title = $request->title;
		$tab->slug = Str::slug($request->title);

		$tab->save();

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
		$tab = TeacherTab::findOfFail($id);
		return view('admin.teacher.teacher-info.index', compact('tab'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'		=> 'required|string'
		]);

		$tab = TeacherTab::findOrFail($id);
		$tab->title = $request->title;
		$tab->slug = Str::slug($request->title);

		$tab->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		TeacherTab::findOrFail($id)->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
