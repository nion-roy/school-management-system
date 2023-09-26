<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$news = News::latest()->get();
		return view('admin.news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'	=> 'required|string',
			'description' => 'required|string'
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('news')) {
				Storage::disk('public')->makeDirectory('news');
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(640, 480)->stream();
			Storage::disk('public')->put('news/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}


		// return $request;

		$news = new News();
		$news->title = $request->title;
		$news->slug = $slug;
		$news->description = $request->description;
		$news->image	= $imageName;

		if (isset($request->status)) {
			$news->status = true;
		} else {
			$news->status = false;
		}

		$news->save();


		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$news = News::findOrFail($id);
		return view('admin.news.show', compact('news'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$news = News::findOrFail($id);
		return view('admin.news.edit', compact('news'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'	=> 'required|string',
			'description' => 'required|string'
		]);

		$news = News::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('news')) {
				Storage::disk('public')->makeDirectory('news');
			}
			// delete old image
			if (!Storage::disk('public')->exists('news/' . $news->image)) {
				Storage::disk('public')->delete('news/' . $news->image);
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(640, 480)->stream();
			Storage::disk('public')->put('news/' . $imageName, $resizeImage);
		} else {
			$imageName = $news->image;
		}


		// return $request;

		$news->title = $request->title;
		$news->slug = $slug;
		$news->description = $request->description;
		$news->image	= $imageName;

		if (isset($request->status)) {
			$news->status = true;
		} else {
			$news->status = false;
		}

		$news->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$news = News::findOrFail($id);
		// delete old image
		if (!Storage::disk('public')->exists('news/' . $news->image)) {
			Storage::disk('public')->delete('news/' . $news->image);
		}

		$news->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
