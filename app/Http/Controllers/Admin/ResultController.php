<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Batch;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ResultController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$results = Result::latest()->get();
		return view('admin.result.index', compact('results'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$departments = Batch::get();
		return view('admin.result.create', compact('departments'));
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

		// return $request;

		$pdfFile = $request->file('pdf');
		$slug = Str::slug($request->title);
		$currentData = Carbon::now()->toDateString();

		if (isset($pdfFile)) {
			$pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('result')) {
				Storage::disk('public')->makeDirectory('result');
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('result/' . $pdfName, $pdfData);
		} else {
			$pdfName = 'default.pdf';
		}

		$result = new Result();
		$result->title  = $request->title;
		$result->slug  = $slug;
		$result->class_id  = $request->class_id;
		$result->type  = $request->type;
		$result->pdf  = $pdfName;

		if (isset($request->status)) {
			$result->status = true;
		} else {
			$result->status = false;
		}

		$result->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$auth = Auth::user();
		$results = Result::findOrFail($id);
		return view('admin.result.show', compact('results', 'auth'));

		// return response()->file(public_path("storage/result/$results->pdf"), ['content-type' => 'application/pdf']);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$departments = Batch::get();
		$results = Result::findOrFail($id);
		return view('admin.result.edit', compact('results', 'departments'));
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

		$result = Result::findOrFail($id);

		$pdfFile = $request->file('pdf');
		$slug = Str::slug($request->title);
		$currentData = Carbon::now()->toDateString();

		if (isset($pdfFile)) {
			$pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('result')) {
				Storage::disk('public')->makeDirectory('result');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('result/' . $result->pdf)) {
				Storage::disk('public')->delete('result/' . $result->pdf);
			}
			// pdf for add in exists
			$pdfData = file_get_contents($pdfFile);
			Storage::disk('public')->put('result/' . $pdfName, $pdfData);
		} else {
			$pdfName = $result->pdf;
		}


		$result->title  = $request->title;
		$result->slug  = $slug;
		$result->class_id  = $request->class_id;
		$result->type  = $request->type;
		$result->pdf  = $pdfName;

		if (isset($request->status)) {
			$result->status = true;
		} else {
			$result->status = false;
		}

		$result->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$results = Result::findOrFail($id);
		// check old image & delete is exists
		if (Storage::disk('public')->exists('result/' . $results->pdf)) {
			Storage::disk('public')->delete('result/' . $results->pdf);
		}
		$results->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}


	/**
	 * Download the specified resource from storage.
	 */
	public function download(string $id)
	{
		$download = DB::table('results')->where('id', $id)->first();
		if (isset($download)) {
			$path = public_path("storage/result/$download->pdf");
			if (file_exists($path)) {
				// Increment the view count
				DB::table('results')->where('id', $id)->increment('view_count', 1);
				return Response::download($path);
			} else {
				Toastr::error("File not found", 'Error');
				return redirect()->back();
			}
		}
	}
}
