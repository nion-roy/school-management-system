<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view('contact');
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'			=> 'required|string',
			'email'			=> 'required|email',
			'subject'		=> 'required|string',
			'message'		=> 'required|string',
		]);

		// return $request;

		$message = new UserMessage();
		$message->name 		= $request->name;
		$message->email 	= $request->email;
		$message->subject = $request->subject;
		$message->message = $request->message;
		$message->save();

		Session::flash('flash_message', 'Your message successfully added!');
		return redirect()->back();
	}

}
