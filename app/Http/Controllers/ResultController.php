<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;

class ResultController extends Controller
{
	public function result()
	{
		$results = Result::latest()->where('status', true)->paginate(10);
		return view('result', compact('results'));
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
