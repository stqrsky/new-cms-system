<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index() {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }
    public function store() {

        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')   // seperate every word with " - "
        ]);
        return back();
    }

    public function edit(Role $role) {
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions' => Permission::all()
            ]);
    }

    public function update(Role $role) {
        $role->name = Str::ucfirst(request('name'));      // modify the name coming from request, to-> $role->name
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');   // seperate every word with " - " / Str::of = this is where we're working on..

        if($role->isDirty('name')) {                       // boolean value // or isClean
            session()->flash('role-updated', 'Role Updated: '.request('name'));   //concatenate with new created name
            $role->save();
        } else {
            session()->flash('role-updated', 'Nothing has been updated');
        }

        return back();
    }


    public function attach_permission(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }
    public function detach_permission(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }


    public function destroy(Role $role) {
        $role->delete();

        session()->flash('role-delete', 'Deleted Role' . $role->name);

        return back();
    }
}
