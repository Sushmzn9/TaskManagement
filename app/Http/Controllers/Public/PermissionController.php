<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        if ($request->permission_type === "basic") {
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
            Session::flash('success', 'Permission created successfully');
        } else if ($request->permission_type === 'curd') {

            $request->validate([
                'resource' => ['required'],

            ]);
            $curd = $request->curdSelection;
            if (count($curd) > 0) {
                foreach ($curd as $item) {
                    $name = strtolower($request->resource) . "-" . strtolower($item);
                    $display_name = ucwords($request->resource . ' ' . $item);
                    $description = ucwords($request->description . ' ' . $item);
                    Permission::create([
                        'name' => $name,
                        'display_name' => $display_name,
                        'description' => $description,
                    ]);
                }
            }
            Session::flash('success', 'Permissions created successfully');
        }
        return redirect()->route('permission.index');
    }


    public function permissionEdit($id)
    {
        $permissions = Permission::findOrfail($id);
        return view('managements.permissions.edit', compact('permissions'));
    }

    public function permissionUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'display_name' => ['required'],
            'description' => ['required'],
        ]);

        Permission::where('id', $id)->update([
            "name" => $request->name,
            "display_name" => $request->display_name,
            "description" => $request->description,

        ]);
        Session::flash('success', 'Permission updated successfully');
        return redirect()->route('permission.index');
    }


    public function permissionDelete($id)
    {
        $permission = Permission::findOrfail($id);
        $permission->delete();
        return back();
    }
}
