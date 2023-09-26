<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
	public function imageGallery()
	{
		$imageGallery = Gallery::where('gallery_type', 'image')->latest()->paginate(12);
		return view('gallery', compact('imageGallery'));
	}
	public function imageGalleryDetails($slug)
	{
		$imageGalleryDetails = Gallery::where('slug', $slug)->get()->first();
		return view('gallery-details', compact('imageGalleryDetails'));
	}
}
