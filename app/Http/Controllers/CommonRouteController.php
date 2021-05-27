<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

class CommonRouteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->hasRole('user')) {
            return view('user.index');
        } else if(Auth::user()->hasRole('admin')) {
            return view('admin.index');
        }
    }

    public function profile() {
        return view('common.profile');
    }

    public function profile_edit() {
        return view('common.edit');
    }

    public function password() {
        return view('common.password');
    }
}
