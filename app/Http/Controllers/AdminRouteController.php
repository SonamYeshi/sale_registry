<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRouteController extends Controller
{
    // Constructor
    public function __construct() {
        $this->middleware('auth');
    }

    // GET :: Manager User
    public function manage_users()
    {
        $userList = User::paginate(5);
        return view('admin.manage', compact('userList'));
    }

    // Search User
    public function search(Request $request)
    {
        $tags = $request->get('tag');
        $userList = User::where('name', 'like', '%'.$tags.'%')
        ->orWhere('empID', 'like', '%'.$tags.'%')->paginate(5);
        return view('admin.manage', compact('userList'));
    }

    // GET :: Add User
    public function add_user()
    {
        return view('admin.add');
    }

    // POST :: Add User
    protected function user_add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'emp' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $usr = User::create([
            'name' => $request->input('name'),
            'empID' => Str::upper($request->input('emp')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $usr->attachRole($request->input('roletype'));
        return redirect('manage_users');
    }

    // GET :: Edit User
    public function edit_user($id)
    {
        if($id == auth()->user()->id) {
            abort(403, 'Access Denied');
        } else {
            return view('admin.edit')->with('user', User::find($id));
        }
    }

    // POST :: Update User
    public function update_user(Request $request, $id)
    {
        $usr = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'emp' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if($request->filled('password')) {
            $request->validate(['password'=> ['string', 'min:8']]);

            $usr->update([
                'name' => $request->input('name'),
                'empID' => Str::upper($request->input('emp')),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
             $usr->update([
                    'name' => $request->input('name'),
                    'empID' => Str::upper($request->input('emp')),
                    'email' => $request->input('email'),  
            ]);
        }
        
        // Detaching Role Before Assigning The Updated Role
        if($usr->hasRole('user')) { $usr->detachRole('user'); } else { $usr->detachRole('admin'); }

        // Updating the Role
        User::find($id)->attachRole($request->input('roletype'));

        return redirect('manage_users');
    }

    // DELETE :: Delete User
    public function delete_user(User $id)
    {
        $id->delete();
        return redirect('manage_users');
    }
}