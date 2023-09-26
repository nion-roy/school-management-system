<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PaymentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$payments = Payment::latest()->get();
		return view('admin.payment.index', compact('payments'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.payment.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'payment_name'		=> 'required|unique:payments',
			'payment_number'		=> 'required|numeric|digits:11'
		]);

		$payments = new Payment();
		$payments->payment_name  = $request->payment_name;
		$payments->payment_number  = $request->payment_number;

		if (isset($request->status)) {
			$payments->status = true;
		} else {
			$payments->status = false;
		}

		$payments->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$payments = Payment::findOrFail($id);
		return view('admin.payment.edit', compact('payments'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'payment_name'		=> 'required',
			'payment_number'		=> 'required|numeric|digits:11'
		]);

		$payments = Payment::findOrFail($id);
		$payments->payment_name  = $request->payment_name;
		$payments->payment_number  = $request->payment_number;

		if (isset($request->status)) {
			$payments->status = true;
		} else {
			$payments->status = false;
		}

		$payments->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$payments = Payment::findOrFail($id);
		$payments->delete();
		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
