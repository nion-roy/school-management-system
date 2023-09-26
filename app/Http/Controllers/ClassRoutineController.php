<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;

class ClassRoutineController extends Controller
{
	/**
	 * Class routine the specified resource from storage.
	 */
	public function classRoutine()
	{
		$classRoutines = ClassRoutine::latest()->where('status', true)->paginate(10);
		return view('class-routine', compact('classRoutines'));
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
