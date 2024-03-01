<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentContoller extends Controller
{
    //vue js
    public function storeDepartment(Request $request)
    {

        Department::create([
            'name' => $request->name,

            'user_id' => 1,
        ]);

        return response()->json('success');
    }
    public function getDepartments()
    {

        $data = Department::all();

        return json_encode($data);
    }

    public function updateDepartment(Request $request, $id)
    {

        Department::where('id', $id)->update([
            'name' => $request->name,
            'user_id' => 1,
        ]);

        return response()->json('success');
    }

    public function deleteDepartment($id)
    {
        $item = Department::findOrfail($id);
        $item->delete();

        return response()->json('success');
    }
    //below code is related to laravel curd
    public function departmentIndex()
    {
        $departments = Department::all();
        return view('managements.departments.index', compact('departments'));
    }

    public function departmentCreate()
    {
        return view('managements.departments.create');
    }

    public function departmentStore(Request $request)
    {

        $request->validate([
            'name' => ['required'],

        ]);

        Department::create([
            'name' => $request->name,
            'user_id' => 1,
        ]);
        Session::flash('success', 'Department created successfully');
        return redirect()->route('departments.index');
    }

    public function departmentEdit($id)
    {
        $department = Department::findOrfail($id);
        ray('mmy first ray call');
        return view('managements.departments.edit', compact('department'));
    }
    public function departmentUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],

        ]);
        Department::where('id', $id)->update([
            'name' => $request->name,

        ]);
        Session::flash('success', 'Department updated successfully');

        return redirect()->route('departments.index');
    }
    public function departmentDelete($id)
    {
        Department::where('id', $id)->delete();
        Session::flash('success', 'Department created successfully');

        return back();
    }
}
