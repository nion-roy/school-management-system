<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
	public function index()
	{
		return view('admin.login.login');
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
			'remember' => 'required'
		]);

		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials, $request->has('remember'))) {
			if (Auth::check() && Auth::user()->role == 'admin') {
				Toastr::success('Admin Login Successfully', 'Success');
				return redirect()->route('admin.dashboard');
			} else {
				Alert::error('Error', 'These credentials do not match our records.');
				return redirect()->route('admin.login');
			}
		} else {
			Alert::error('Error', 'These credentials do not match our records.');
			return redirect()->route('admin.login');
		}
	}
}
