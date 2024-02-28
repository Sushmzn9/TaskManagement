<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function rolesIndex()
     {
        $roles = Role::all();
        return view('managements.roles.index', compact('roles'));

    }

    public function rolesCreate(){
        return view('managements.roles.create');
    }

public function  rolesStore(Request $request){
    $request->validate([
        'name' => ['required'],
        'display_name' => ['required'],
        'description' => ['required'],
    ]);

    Role::create([
        'name' => $request->name,
        'display_name' => $request->display_name,
        'description' =>  $request->description,
    ]);
    Session::flash('success', 'Roles created successfully');
    return redirect()->route('roles.index');
}


public function rolesEdit($id)
{
    $role = Role::findOrfail($id);
    return view('managements.roles.edit', compact('role'));
}

public function rolesUpdate (Request $request, $id)
{
    $request->validate([
        'name' => ['required'],
        'display_name' => ['required'],
        'description' => ['required'],
    ]);
    Role::where('id', $id)->update([
        'name' => $request->name,
        'display_name' => $request->display_name,
        'description' =>  $request->description,
    ]);
    Session::flash('success', 'Roles updated successfully');

    return redirect()->route('roles.index');
}

public function rolesDelete($id){
   $role = Role::findOrfail($id);
   $role->delete();
   return back();
}
}
