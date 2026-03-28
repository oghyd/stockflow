<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    //Display the list of users
    public function index()
    {
        $users = User::latest()->paginate(10); //latest first and limit to 10
        return view('admin.users.index', compact('users'));
    }

    //Create user
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    //Submitted form after user creation
    public function store(Request $request)
    {
        $data = $request->validate([ //validate before saving to DB, never trust input from a form
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', //email must be unique (important)
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([ //calling the create function
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), //password hash (crutial)
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('admin.users.index');
    }

    //Edit a specific user
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles')); //send user AND role so the form can show both current vals
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]); // Roles are stored in pivot tables, so we don't just do $user->update($data); bc data has role and user doesn't

        $user->syncRoles([$data['role']]); //we don't use assignRole because we want to change the role not add nother one

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}