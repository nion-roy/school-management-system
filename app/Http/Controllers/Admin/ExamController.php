<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Admission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ExamController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$exams = Exam::latest()->get();
		return view('admin.exam-routine.index', compact('exams'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$departments = Batch::get();
		return view('admin.exam-routine.create', compact('departments'));
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
			if (!Storage::disk('public')->exists('exam')) {
				Storage::disk('public')->makeDirectory('exam');
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('exam/' . $pdfName, $pdfData);
		} else {
			$pdfName = 'default.pdf';
		}


		$exam = new Exam();
		$exam->title = $request->title;
		$exam->slug = $slug;
		$exam->class_id  = $request->class_id;
		$exam->type  = $request->type;
		$exam->pdf = $pdfName;
		if (isset($request->status)) {
			$exam->status = true;
		} else {
			$exam->status = false;
		}

		$exam->save();

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
		$exams = Exam::findOrFail($id);
		return view('admin.exam-routine.edit', compact('exams', 'departments'));
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


		$exam = Exam::findOrFail($id);
		$pdfFile = $request->file('pdf');
		$slug = Str::slug($request->title);
		$currentData = Carbon::now()->toDateString();

		if (isset($pdfFile)) {
			$pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('exam')) {
				Storage::disk('public')->makeDirectory('exam');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('exam/' . $exam->pdf)) {
				Storage::disk('public')->delete('exam/' . $exam->pdf);
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('exam/' . $pdfName, $pdfData);
		} else {
			$pdfName = $exam->pdf;
		}


		$exam->title = $request->title;
		$exam->slug = $slug;
		$exam->class_id  = $request->class_id;
		$exam->type  = $request->type;
		$exam->pdf = $pdfName;
		if (isset($request->status)) {
			$exam->status = true;
		} else {
			$exam->status = false;
		}

		$exam->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$exams = Exam::findOrFail($id);
		// check old image & delete is exists
		if (Storage::disk('public')->exists('result/' . $exams->pdf)) {
			Storage::disk('public')->delete('result/' . $exams->pdf);
		}
		$exams->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Download the specified resource from storage.
	 */
	public function download(string $id)
	{
		$exams = Exam::findOrFail($id);
		if (isset($exams)) {
			$path = public_path("storage/exam/$exams->pdf");
			if (file_exists($path)) {
				// Increment the view count
				$exams->increment('view_count', 1);
				return Response::download($path);
			} else {
				Toastr::error("File not found", 'Error');
				return redirect()->back();
			}
		}
	}
}
