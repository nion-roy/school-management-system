<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\StudentResult;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = StudentResult::latest()->get();
        return view('teacher.result.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('status', true)->get();
        $subjects = Subject::where('status', true)->get();
        $student = Student::where('status', true)->get();
        return view('teacher.result.create', compact('batches', 'subjects', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $this->validate($request, [
            'class_id'    => 'required',
            'student_id'  => 'required',
            'subject_id'  => 'required',
            'mark'        => 'required',
        ]);


        $results = new StudentResult();
        $results->class_id = $request->class_id;
        $results->student_id = $request->student_id;
        $results->subject_id = $request->subject_id;
        $results->mark = $request->mark;

        if (isset($request->status)) {
            $results->status = true;
        } else {
            $results->status = false;
        }

        $results->save();

        Toastr::success('You have Create the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = StudentResult::findOrFail($id);
        $allResults = StudentResult::where('status', 1)->get();
        return view('teacher.result.show', compact('result', 'allResults'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $result = StudentResult::findOrFail($id);
        $batches = Batch::where('status', true)->get();
        $subjects = Subject::where('status', true)->get();
        $student = Student::where('status', true)->get();
        return view('teacher.result.edit', compact('batches', 'subjects', 'student', 'result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'class_id'    => 'required',
            'student_id'  => 'required',
            'subject_id'  => 'required',
            'mark'        => 'required',
        ]);

        $results = StudentResult::findOrFail($id);
        $results->class_id = $request->class_id;
        $results->student_id = $request->student_id;
        $results->subject_id = $request->subject_id;
        $results->mark = $request->mark;

        if (isset($request->status)) {
            $results->status = true;
        } else {
            $results->status = false;
        }

        $results->update();

        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StudentResult::findOrFail($id)->delete();
        Toastr::success('You have Delete the data Successfully', 'Success');
        return redirect()->back();
    }


    public function getRolls($id)
    {
        $roll = Student::where('class_id', $id)->get();
        return response()->json($roll);
    }

    public function getInformation($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }
}
