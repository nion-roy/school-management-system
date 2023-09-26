<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$mission = Mission::latest()->get();
		return view('admin.mission.index', compact('mission'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.mission.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|string|unique:missions',
			'description'		=> 'required|string',
			'image'		=> 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('about')) {
				Storage::disk('public')->makeDirectory('about');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(600, 600)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$mission = new Mission();
		$mission->title 		=	$request->title;
		$mission->description 		=	$request->description;
		$mission->image 		=	$imageName;
		$mission->slug 		=	$slug;

		if (isset($request->status)) {
			$mission->status = true;
		} else {
			$mission->status = false;
		}

		$mission->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$auth = Auth::user();
		$mission = Mission::findOrFail($id);
		return view('admin.mission.show', compact('mission', 'auth'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$mission = Mission::findOrFail($id);
		return view('admin.mission.edit', compact('mission'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'		=> 'required|string',
			'description'		=> 'required|string',
			'image'		=> 'image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		$mission = Mission::findOrFail($id);
		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('about')) {
				Storage::disk('public')->makeDirectory('about');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('about/' . $mission->image)) {
				Storage::disk('public')->delete('about/' . $mission->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(600, 600)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = $mission->image;
		}

		$mission->title 		=	$request->title;
		$mission->description 		=	$request->description;
		$mission->image 		=	$imageName;
		$mission->slug 		=	$slug;

		if (isset($request->status)) {
			$mission->status = true;
		} else {
			$mission->status = false;
		}

		$mission->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$mission = Mission::findOrFail($id);

		// check old image & delete is exists
		if (Storage::disk('public')->exists('about/' . $mission->image)) {
			Storage::disk('public')->delete('about/' . $mission->image);
		}

		$mission->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
