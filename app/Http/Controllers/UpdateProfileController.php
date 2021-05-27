<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UpdateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_img' => ['mimes:jpg, jpeg, png, bmp, gif, tiff', 'max:5048'],
            'name' => ['required', 'string', 'max:200'],
            'emp' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if($request->profile_img != null) {
            $newImageName = time() . '-' . $request->name . '.' . $request->profile_img->extension();
            $request->profile_img->move(public_path('img/profile'), $newImageName);
            User::find(auth()->user()->id)->update(['profile_path'=> $newImageName]);
        }

        User::find(auth()->user()->id)->update([
            'name' => $request->input('name'),
            'empID' => Str::upper($request->input('emp')),
            'email' => $request->input('email')
        ]);

        Session::flash('msg', 'Profile Updated Successfully'); 
        return redirect('profile');
    }
}