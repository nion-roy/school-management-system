<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
	public function news()
	{
		$newses = News::latest()->where('status', true)->paginate(12);
		return view('news', compact('newses'));
	}

	public function newsDetails(string $slug)
	{
		$newses = News::where('slug', $slug)->get()->first();
		return view('news-details', compact('newses'));
	}
}
