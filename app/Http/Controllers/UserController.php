<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // DISPLAYING ALL USERS // ADMIN USERS PHASE
    public function index() {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }


    public function show(User $user) {
        return view('admin.users.profile', [
            'user' => $user,
            'roles' => Role::all()
            ]);
    }

    public function update(User $user) {

        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', ' alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar' => ['file'],   // specific: 'avatar => ['file:jpeg,png']
        
        ]);

        if(request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');     // if requested avatar exists and store it in images, put it in the $input-array-validation.
        }

        $user->update($inputs);

        return back();

    }


    public function attach(User $user) {
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user) {
        $user->roles()->detach(request('role'));
        return back();
    }



    public function destroy(User $user) {
        $user->delete();

        session()->flash('user-deleted', 'User has been deleted');

        return back();
    }

}
