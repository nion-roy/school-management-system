<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chairman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ChairmanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$chairman = Chairman::latest()->get();
		return view('admin.chairman.index', compact('chairman'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.chairman.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|string|unique:chairmen',
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
			$resizeImage = Image::make($image)->resize(602, 668)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$chairman = new Chairman();
		$chairman->title 		=	$request->title;
		$chairman->description 		=	$request->description;
		$chairman->image 		=	$imageName;
		$chairman->slug 		=	$slug;

		if (isset($request->status)) {
			$chairman->status = true;
		} else {
			$chairman->status = false;
		}

		$chairman->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$auth = Auth::user();
		$chairman = Chairman::findOrFail($id);
		return view('admin.chairman.show', compact('chairman', 'auth'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$chairman = Chairman::findOrFail($id);
		return view('admin.chairman.edit', compact('chairman'));
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

		$chairman = Chairman::findOrFail($id);
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
			if (Storage::disk('public')->exists('about/' . $chairman->image)) {
				Storage::disk('public')->delete('about/' . $chairman->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(602, 668)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = $chairman->image;
		}

		$chairman->title 		=	$request->title;
		$chairman->description 		=	$request->description;
		$chairman->image 		=	$imageName;
		$chairman->slug 		=	$slug;

		if (isset($request->status)) {
			$chairman->status = true;
		} else {
			$chairman->status = false;
		}

		$chairman->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$chairman = Chairman::findOrFail($id);

		// check old image & delete is exists
		if (Storage::disk('public')->exists('about/' . $chairman->image)) {
			Storage::disk('public')->delete('about/' . $chairman->image);
		}

		$chairman->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
