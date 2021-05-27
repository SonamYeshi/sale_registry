<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRouteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function registerSale() {
        return view('user.register');
    }

    public function verifyInfo() {
        return view('user.verify');
    }

    public function user_entries() {
        return view('user.entries');
    }

    public function edit_entry($id) {

        // Passing variable id to fetch_specific.js
        echo "<script> var array = { arrayID : $id }; </script>";
        
        return view('user.edit_entry');
    }
}
