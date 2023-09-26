<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('teacher.profile.index');
    }

    public function updateProfile(Request $request)
    {

        $this->validate($request, [
            'name'        => 'required',
            'email'        => 'required',
            'about'        => 'required',
            'image'        => 'mimes:jpg,jpeg,png,webp|max:3072'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $image = $request->file('image');
        $slug = Str::slug(Auth::user()->name);

        if (isset($image)) {
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }

            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }

            $setImage = Image::make($image)->resize(260, 260)->stream();
            Storage::disk('public')->put('profile/' . $imageName, $setImage);
        } else {
            $imageName = $user->image;
        }

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->about    = $request->about;
        $user->image    = $imageName;
        $user->save();

        Alert::success('Success', 'Profile Successfully Update');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'        => 'required',
            'password'        => 'required|confirmed|min:8'
        ]);

        $hashPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashPassword)) {
            if (!Hash::check($request->password, $hashPassword)) {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->password);
                $user->save();

                Alert::success('Success', 'Password Successfully Change');
                return redirect()->back();
            } else {
                Alert::error('Error', 'New password connot be the same as old password');
                return redirect()->back();
            }
        } else {
            Alert::error('Error', 'Current password not match');
            return redirect()->back();
        }
    }
}
