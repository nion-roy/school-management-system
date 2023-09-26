<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vision;
use App\Models\Vission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class VisionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
	$vision = Vision::latest()->get();
		return view('admin.vision.index', compact('vision'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.vision.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|string|unique:visions',
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

		$vision = new Vision();
		$vision->title 		=	$request->title;
		$vision->description 		=	$request->description;
		$vision->image 		=	$imageName;
		$vision->slug 		=	$slug;

		if (isset($request->status)) {
			$vision->status = true;
		} else {
			$vision->status = false;
		}

		$vision->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$auth = Auth::user();
		$vision = Vision::findOrFail($id);
		return view('admin.vision.show', compact('vision', 'auth'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$vision = Vision::findOrFail($id);
		return view('admin.vision.edit', compact('vision'));
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

		$vision = Vision::findOrFail($id);
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
			if (Storage::disk('public')->exists('about/' . $vision->image)) {
				Storage::disk('public')->delete('about/' . $vision->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(600, 600)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = $vision->image;
		}

		$vision->title 		=	$request->title;
		$vision->description 		=	$request->description;
		$vision->image 		=	$imageName;
		$vision->slug 		=	$slug;

		if (isset($request->status)) {
			$vision->status = true;
		} else {
			$vision->status = false;
		}

		$vision->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$vision = Vision::findOrFail($id);

		// check old image & delete is exists
		if (Storage::disk('public')->exists('about/' . $vision->image)) {
			Storage::disk('public')->delete('about/' . $vision->image);
		}

		$vision->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
