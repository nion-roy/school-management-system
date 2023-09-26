<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserStudent;
use App\Models\UserTeacher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$admin = User::where('role', 'admin')->count();
		$subAdmin = User::where('role', 'sub-admin')->count();
		$admins = User::where('role', 'admin')->orWhere('role', 'sub-admin')->latest()->get();
		return view('admin.user.admin.index', compact('admins', 'admin', 'subAdmin'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.user.admin.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// return $request;

		$this->validate($request, [
			'role'		=> 'required|string',
			'email'		=> 'required|email|unique:users',
			'contact'		=> 'required|numeric|unique:users',
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('user')) {
				Storage::disk('public')->makeDirectory('user');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(160, 160)->stream();
			Storage::disk('public')->put('user/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		if ($user = new User()) {
			$user->name = $request->name;
			$user->role = $request->role;
			$user->email = $request->email;
			$user->contact = $request->contact;
			$user->image = $imageName;
			$user->gender  =  $request->gender;
			$user->password = Hash::make('12345678');

			if (isset($request->status)) {
				if ($request->role == 'admin' || $request->role == 'sub-admin') {
					$user->status = false;
				} else {
					$user->status = true;
				}
			} else {
				$user->status = false;
			}

			$user->save();

			if ($user->role == 'teacher') {
				# code...
				$teacher = new UserTeacher();
				$teacher->user_id = $user->id;
				$teacher->title 		=	$request->title;
				$teacher->facebook 		=	$request->facebook;
				$teacher->twitter 		=	$request->twitter;
				$teacher->instagram 		=	$request->instagram;
				$teacher->save();
			} else {
				$student = new UserStudent();
				$student->user_id = $user->id;
				$student->father_name = $request->father_name;
				$student->mother_name = $request->mother_name;
				$student->guardian_contact = $request->guardian_contact;
				$student->present_address = $request->present_address;
				$student->parament_address = $request->parament_address;
				$student->save();
			}
		}


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
		$user = User::findOrFail($id);
		$teacher = UserTeacher::where('user_id', $id)->first();
		$student = UserStudent::where('user_id', $id)->first();
		return view('admin.user.admin.edit', compact('user', 'teacher', 'student'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'role'		=> 'required|string',
			'email'		=> 'required|email',
			'contact'		=> 'required|numeric',
		]);

		if ($user = User::findOrFail($id)) {

			// get form image
			$image = $request->file('image');
			$slug = Str::slug($request->name);

			if (isset($image)) {
				// make unique name for image
				$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
				// check post dir is exists
				if (!Storage::disk('public')->exists('user')) {
					Storage::disk('public')->makeDirectory('user');
				}
				// check post dir and delete old photo
				if (!Storage::disk('public')->exists('user/' . $user->image)) {
					Storage::disk('public')->makeDirectory('user/' . $user->image);
				}
				// resize image for post add upload
				$resizeImage = Image::make($image)->resize(160, 160)->stream();
				Storage::disk('public')->put('user/' . $imageName, $resizeImage);
			} else {
				$imageName = $user->image;
			}

			$user->name = $request->name;
			$user->role = $request->role;
			$user->email = $request->email;
			$user->contact = $request->contact;
			$user->image = $imageName;
			$user->gender  =  $request->gender;
			$user->password = Hash::make('12345678');

			if (isset($request->status)) {
				if ($request->role == 'admin' || $request->role == 'sub-admin') {
					$user->status = true;
				} else {
					$user->status = true;
				}
			} else {
				$user->status = false;
			}

			$user->update();

			if ($user->role == 'teacher') {
				$teacher = UserTeacher::where('user_id', $id)->first();
				$teacher->user_id = $user->id;
				$teacher->title 		=	$request->title;
				$teacher->facebook 		=	$request->facebook;
				$teacher->twitter 		=	$request->twitter;
				$teacher->instagram 		=	$request->instagram;
				$teacher->teacher_type 		=	$request->teacher_type;
				$teacher->update();
			}
			if ($user->role == 'user') {
				$student = UserStudent::where('user_id', $id)->first();
				$student->father_name = $request->father_name;
				$student->mother_name = $request->mother_name;
				$student->guardian_contact = $request->guardian_contact;
				$student->present_address = $request->present_address;
				$student->parament_address = $request->parament_address;
				$student->student_type = $request->student_type;
				$student->update();
			}
		}

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$user = User::findOrFail($id);
		// check post dir and delete old photo
		if (!Storage::disk('public')->exists('user/' . $user->image)) {
			Storage::disk('public')->makeDirectory('user/' . $user->image);
		}
		$user->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function teachers()
	{
		$teachers = UserTeacher::latest()->get();
		// $teacher = User::where('role', 'teacher')->latest()->get();
		return view('admin.user.teacher.index', compact('teachers'));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function students()
	{
		$students = UserStudent::latest()->get();
		return view('admin.user.student.index', compact('students'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function studentDetails(string $id)
	{
		$student = UserStudent::findOrFail($id);
		return view('admin.user.student.show', compact('student'));
	}
}
