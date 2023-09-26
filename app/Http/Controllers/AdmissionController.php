<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Models\AdmissionDetails;
use App\Models\AdmissionSemester;
use App\Models\AdmissionSemesterDetails;

class AdmissionController extends Controller
{
	public function index(string $slug)
	{
		$admissions = Admission::where('slug', $slug)->firstOrFail();
		$admissionDetails = AdmissionDetails::where('status', true)->latest()->get();
		return view('admission', compact('admissions', 'admissionDetails'));
	}


	public function show($id)
	{
		$admissions = Admission::findOrFail($id);
		$details = AdmissionDetails::findOrFail($id);
		$semesters = AdmissionSemester::get();
		$semestersDetails = AdmissionSemesterDetails::get();
		return view('admission-details', compact('admissions', 'details', 'semesters', 'semestersDetails'));
	}
}
