<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use Illuminate\Support\Str;
use App\Rules\BdPhoneNumber;
use Illuminate\Http\Request;
use App\Models\AdmissionDetails;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StudentAdmissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$onlineAdmissions = StudentAdmission::where('admission', 'online')->count();
		$offlineAdmissions = StudentAdmission::where('admission', 'offline')->count();
		$addmissions = StudentAdmission::latest()->get();
		return view('admin.student-admission.index', compact('addmissions', 'onlineAdmissions', 'offlineAdmissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$batches = Batch::latest()->get();
		$subjects = AdmissionDetails::latest()->get();
		return view('admin.student-admission.create', compact('subjects', 'batches'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'				=> 'required|string',
			'nid'					=> 'required|integer',
			'subject_id'	=> 'required',
			'number'			=> 'required|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
			'optional_number'		=>  'nullable|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
			'email'				=> 'required|email',
			'ssc_result'	=> 'required|numeric|min:1|max:5',
			'hsc_result'	=> 'required|numeric|min:1|max:5',
			'gender'			=> 'required|string',
			'religion'		=> 'required|string',
			'present_address'		=> 'required|string',
			'permanent_address'	=> 'required|string',
			'blood_group'	=> 'required|string',
			'father_name'	=> 'required|string',
			'mother_name'	=> 'required|string',
			'father_nid'	=> 'required|integer',
			'mother_nid'	=> 'required|integer',
			'guardian_number' => 'required|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
			'image'				=> 'required|image|mimes:png,jpg,jpeg|max:3072',
			'certificate'	=> 'required|image|mimes:png,jpg,jpeg|max:3072',
		]);



		// get form image
		$image = $request->file('image');
		$name = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $name . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('students')) {
				Storage::disk('public')->makeDirectory('students');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('students/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		// get form image
		$image = $request->file('certificate');
		$name = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageNameCertificate = $name . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('students/certificate')) {
				Storage::disk('public')->makeDirectory('students/certificate');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(360, 260)->stream();
			Storage::disk('public')->put('students/certificate/' . $imageNameCertificate, $resizeImage);
		} else {
			$imageNameCertificate = 'default.png';
		}


		$student = new StudentAdmission();
		$student->name  =  $request->name;
		$student->subject_id  =  $request->subject_id;
		$student->nid  =  $request->nid;
		$student->number  =  $request->number;
		$student->optional_number  =  $request->optional_number;
		$student->email  =  $request->email;
		$student->ssc_result  =  $request->ssc_result;
		$student->hsc_result  =  $request->hsc_result;
		$student->gender  =  $request->gender;
		$student->certificate  =  $imageNameCertificate;
		$student->religion  =  $request->religion;
		$student->present_address  =  $request->present_address;
		$student->permanent_address  =  $request->permanent_address;
		$student->blood_group  =  $request->blood_group;
		$student->father_name  =  $request->father_name;
		$student->mother_name  =  $request->mother_name;
		$student->father_nid  =  $request->father_nid;
		$student->mother_nid  =  $request->mother_nid;
		$student->guardian_number  =  $request->guardian_number;
		$student->payment_type  =  $request->payment_type;
		$student->transaction_number  =  $request->transaction_number;
		$student->batch_id  =  $request->batch_id;
		$student->image  =  $imageName;

		$student->admission  =  'offline';
		$student->is_approved  =  true;

		DB::table('student_admissions')->where('id', $student->roll)->increment('roll', 1);

		DB::table('batches')->where('id', $student->batch_id)->increment('fil_up_seat', 1);
		DB::table('batches')->where('id', $student->batch_id)->decrement('empty_seat', 1);

		$student->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$admissions = StudentAdmission::findOrFail($id);
		return view('admin.student-admission.show', compact('admissions'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$subjects = AdmissionDetails::latest()->get();
		$batches = Batch::latest()->get();
		$addmissions = StudentAdmission::findOrFail($id);
		return view('admin.student-admission.edit', compact('addmissions', 'batches', 'subjects'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{

		$student = StudentAdmission::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$name = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $name . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('students')) {
				Storage::disk('public')->makeDirectory('students');
			}
			//Old image delete in file
			if (Storage::disk('public')->exists('students/' . $student->image)) {
				Storage::disk('public')->delete('students/' . $student->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('students/' . $imageName, $resizeImage);
		} else {
			$imageName = $student->image;
		}

		// get form image
		$image = $request->file('certificate');
		$name = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageNameCertificate = $name . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('students/certificate')) {
				Storage::disk('public')->makeDirectory('students/certificate');
			}
			//Old image delete in file
			if (Storage::disk('public')->exists('students/certificate/' . $student->certificate)) {
				Storage::disk('public')->delete('students/certificate/' . $student->certificate);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(360, 260)->stream();
			Storage::disk('public')->put('students/certificate/' . $imageNameCertificate, $resizeImage);
		} else {
			$imageNameCertificate =  $student->certificate;
		}

		$student->name  =  $request->name;
		$student->subject_id  =  $request->subject_id;
		$student->nid  =  $request->nid;
		$student->number  =  $request->number;
		$student->optional_number  =  $request->optional_number;
		$student->email  =  $request->email;
		$student->ssc_result  =  $request->ssc_result;
		$student->hsc_result  =  $request->hsc_result;
		$student->gender  =  $request->gender;
		$student->certificate  =  $imageNameCertificate;
		$student->religion  =  $request->religion;
		$student->present_address  =  $request->present_address;
		$student->permanent_address  =  $request->permanent_address;
		$student->blood_group  =  $request->blood_group;
		$student->father_name  =  $request->father_name;
		$student->mother_name  =  $request->mother_name;
		$student->father_nid  =  $request->father_nid;
		$student->mother_nid  =  $request->mother_nid;
		$student->guardian_number  =  $request->guardian_number;
		$student->payment_type  =  $request->payment_type;
		$student->transaction_number  =  $request->transaction_number;
		$student->batch_id  =  $request->batch_id;
		$student->image  =  $imageName;

		$student->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$addmissions = StudentAdmission::findOrFail($id);

		//Delete image on file
		if (Storage::disk('public')->exists('students/' . $addmissions->image)) {
			Storage::disk('public')->delete('students/' . $addmissions->image);
		}

		if (Storage::disk('public')->exists('students/certificate/' . $addmissions->certificate)) {
			Storage::disk('public')->delete('students/certificate/' . $addmissions->certificate);
		}
		//Delete image on file

		$addmissions->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}


	public function isApproved(string $id)
	{
		$admission = StudentAdmission::findOrFail($id);
		$admission->is_approved  =  true;
		$admission->update();
		Toastr::success('You have Approved Admission Successfully', 'Success');
		return redirect()->back();
	}
}
