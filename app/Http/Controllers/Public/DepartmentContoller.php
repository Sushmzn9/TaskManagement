<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentContoller extends Controller
{
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
            'director_id' => ['required'],
        ]);

        Department::create([
            'name' => $request->name,
            'director_id' => $request->director_id,
            'user_id' => 1,
        ]);
        Session::flash('success', 'Department created successfully');
        return redirect()->route('departments.index');
    }

    public function departmentEdit($id)
    {
        $department = Department::findOrfail($id);
        return view('managements.departments.edit', compact('department'));
    }
    public function departmentUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'director_id' => ['required'],
        ]);
        Department::where('id', $id)->update([
            'name' => $request->name,
            'director_id' => $request->director_id,
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
