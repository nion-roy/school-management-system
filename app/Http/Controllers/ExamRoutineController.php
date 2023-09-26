<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;

class ExamRoutineController extends Controller
{
	public function examRoutine()
	{
		$examRoutines = Exam::latest()->where('status', true)->paginate(10);
		return view('exam-routine', compact('examRoutines'));
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
