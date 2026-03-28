<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Traits\Loggable;
class UserController extends Controller
{
    //Display the list of users
    public function index(Request $request)
    {
        $role = $request->get('role');
        $email = $request->get('email');

        $users = User::query()
            ->select('users.*')
            ->leftJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', '=', User::class);
            })
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->when($role, function ($query, $role) {
                $query->where('roles.name', $role);
            })
            ->when($email, function ($query, $email) {
                $query->where('users.email', 'like', '%' . $email . '%');
            })
            ->orderByRaw("
                CASE roles.name
                    WHEN 'admin' THEN 1
                    WHEN 'fournisseur' THEN 2
                    WHEN 'vendeur' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('users.name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'role', 'email'));
    }

    //Displays the form (user creation) NO DB involvment
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    //Handles form (user creation)
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

        //Log activity (here user creation)
        Loggable::recordActivity(
            'user_created',
            $user,
            'User '.$user->name.' was created'
        );

        return redirect()->route('admin.users.index');
    }

    //Displays form (edit user)
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles')); //send user AND role so the form can show both current vals
    }

    //Handles form (edit user)
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

        Loggable::recordActivity(
            'user_updated',
            $user,
            'User '.$user->name.' was updated'
        );

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        //Here we log before to be able to record the user data (important)
        Loggable::recordActivity(
            'user_deleted',
            $user,
            'User '.$user->name.' was deleted'
        );

        $user->delete();
        return back();
    }
}