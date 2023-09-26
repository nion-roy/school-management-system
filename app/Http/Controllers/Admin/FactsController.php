<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class FactsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$facts = Facts::latest()->get();
		return view('admin.facts.index', compact('facts'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.facts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'header'	=> 'required|string|unique:facts',
			'counter' => 'required|numeric',
		]);

		$facts = new Facts();
		$facts->header = $request->header;
		$facts->counter = $request->counter;

		$facts->save();

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
		$facts = Facts::findOrFail($id);		
		return view('admin.facts.edit', compact('facts'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'header'	=> 'required|string|unique:facts',
			'counter' => 'required|numeric',
		]);

		$facts = Facts::findOrFail($id);
		$facts->header = $request->header;
		$facts->counter = $request->counter;

		$facts->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$facts = Facts::findOrFail($id);
		$facts->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
