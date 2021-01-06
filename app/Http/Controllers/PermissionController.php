<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function index() {
        return view('admin.permissions.index', [
            'permissions' => Permission::all()
        ]);
    }

    public function store() {
        request()->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')   // seperate every word with " - "
        ]);
        return back();
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission) {
        $permission->name = Str::ucfirst(request('name'));      // modify the name coming from request, to-> $role->name
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');   // seperate every word with " - " / Str::of = this is where we're working on..

        if($permission->isDirty('name')) {                       // boolean value // or isClean
            session()->flash('permission-updated', 'Permission Updated: '.request('name'));   //concatenate with new created name
            $permission->save();
        } else {
            session()->flash('permission-updated', 'Nothing has been updated');
        }

        return back();
    }


    public function destroy(Permission $permission) {
        $permission->delete();
        return back();
    }
}
