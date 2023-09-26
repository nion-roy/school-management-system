<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AdmissionDetails;
use App\Models\StudentAdmission;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OnlineAdmission extends Controller
{
	public function admission()
	{
		$subjects = AdmissionDetails::latest()->get();
		return view('online-admission', compact('subjects'));
	}

	public function store(Request $request)
	{

		// return $request;

		// get form image
		$image = $request->file('transaction_number');
		$name = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageTransactionNumber = $name . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('students/payments')) {
				Storage::disk('public')->makeDirectory('students/payments');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('students/payments/' . $imageTransactionNumber, $resizeImage);
		} else {
			$imageTransactionNumber = 'default.png';
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



		$students = new StudentAdmission();

		$students->subject_id = $request->subject_id;
		$students->payment_id = $request->payment_id;
		$students->nid = $request->nid;
		$students->number = $request->number;
		$students->optional_number = $request->optional_number;
		$students->name = $request->name;
		$students->email = $request->email;
		$students->ssc_result = $request->ssc_result;
		$students->hsc_result = $request->hsc_result;
		$students->certificate = $imageNameCertificate;
		$students->transaction_number = $imageTransactionNumber;
		$students->religion = $request->religion;
		$students->gender = $request->gender;

		$students->admission  =  'online';
		$students->is_approved  =  false;

		$students->save();
		Session::flash('flash_message', 'Your admission successful');
		return redirect()->back();
	}
}
