<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentResult;

class StudentResultController extends Controller
{
    public function index()
    {
        $classes = Batch::where('status', true)->get();
        return view('student-result', compact('classes'));
    }


    public function studentRoll(string $id)
    {
        $roll = Student::where('class_id', $id)->get();
        return response()->json($roll);
    }

    public function studentResults(string $id)
    {
        $results = StudentResult::where('student_id', $id)->with('class')->with('student')->with('subject')->get();
        // return response()->json($results);
        return $results;
    }
}
