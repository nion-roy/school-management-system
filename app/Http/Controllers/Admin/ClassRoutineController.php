<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admission;
use Illuminate\Support\Str;
use App\Models\ClassRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ClassRoutineController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$class = ClassRoutine::latest()->get();
		return view('admin.class-routine.index', compact('class'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$departments = Batch::get();
		return view('admin.class-routine.create', compact('departments'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'					=> 'required|string',
			'class_id'	=> 'required',
			'type'					=> 'required',
			'pdf'						=> 'required|mimes:pdf',
		]);


		$pdfFile = $request->file('pdf');
		$slug = Str::slug($request->title);
		$currentData = Carbon::now()->toDateString();

		if (isset($pdfFile)) {
			$pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('class')) {
				Storage::disk('public')->makeDirectory('class');
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('class/' . $pdfName, $pdfData);
		} else {
			$pdfName = 'default.pdf';
		}


		$class = new ClassRoutine();
		$class->title = $request->title;
		$class->slug = $slug;
		$class->class_id  = $request->class_id;
		$class->type  = $request->type;
		$class->pdf = $pdfName;
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
		$departments = Batch::get();
		$class = ClassRoutine::findOrFail($id);
		return view('admin.class-routine.edit', compact('class', 'departments'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'					=> 'required|string',
			'type'					=> 'required|string',
			'class_id'	=> 'required',
			'pdf'						=> 'mimes:pdf',
		]);


		$class = ClassRoutine::findOrFail($id);
		$pdfFile = $request->file('pdf');
		$slug = Str::slug($request->title);
		$currentData = Carbon::now()->toDateString();

		if (isset($pdfFile)) {
			$pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('class')) {
				Storage::disk('public')->makeDirectory('class');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('class/' . $class->pdf)) {
				Storage::disk('public')->delete('class/' . $class->pdf);
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('class/' . $pdfName, $pdfData);
		} else {
			$pdfName = $class->pdf;
		}


		$class->title = $request->title;
		$class->slug = $slug;
		$class->class_id  = $request->class_id;
		$class->type  = $request->type;
		$class->pdf = $pdfName;
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
		$class = ClassRoutine::findOrFail($id);
		// check old image & delete is exists
		if (Storage::disk('public')->exists('result/' . $class->pdf)) {
			Storage::disk('public')->delete('result/' . $class->pdf);
		}
		$class->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Download the specified resource from storage.
	 */
	public function download(string $id)
	{
		$class = ClassRoutine::findOrFail($id);
		if (isset($class)) {
			$path = public_path("storage/class/$class->pdf");
			if (file_exists($path)) {
				// Increment the view count
				$class->increment('view_count', 1);
				return Response::download($path);
			} else {
				Toastr::error("File not found", 'Error');
				return redirect()->back();
			}
		}
	}
}
