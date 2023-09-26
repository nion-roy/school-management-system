<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		if (Auth::check()) {
			if (Auth::user()->role == 'admin' && Auth::user()->status == true) {
				return $next($request);
			} else {
				Auth::logout();
				Alert::error('Your Account is Pending');
				return redirect()->back();
			}
		} else {
			return redirect()->route('admin.login');
		}
	}
}
