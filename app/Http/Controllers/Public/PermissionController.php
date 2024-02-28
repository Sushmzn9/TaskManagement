<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function permissionIndex()
    {
        $permissions = Permission::all();
        return view('managements.permissions.index', compact('permissions'));
    }
    public function permissionCreate()
    {
        return view('managements.permissions.create');
    }
    public function permissionStore(Request $request)
    {

        if ($request->permision_type === "basic") {
            $request->validate([
                'name' => ['required'],
                'display_name' => ['required'],
                'description' => ['required'],
            ]);

            Permission::create([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "description" => $request->description,

            ]);
        } else if ($request->permission_type === 'curd') {

            $request->validate([
                'resource' => ['required'],

            ]);


            $curd = $request->curdSelection;
            if(count($curd)>0){
                foreach ($curd as $item) {
$name = strtolower($request->resource). "-" . strtolower($item);
            }

        }


        // Role::create([
        //     'name' => $request->name,
        //     'display_name' => $request->display_name,
        //     'description' =>  $request->description,
        // ]);
        // Session::flash('success', 'Roles created successfully');
        // return redirect()->route('roles.index');
    }
}
