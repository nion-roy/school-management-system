<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function videoGallery()
    {
        $imageVideo = Gallery::where('gallery_type', 'video')->latest()->paginate(12);
        return view('gallery', compact('imageVideo'));
    }
}
