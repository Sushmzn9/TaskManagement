<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laratrust\Traits\HasRolesAndPermissions;

use function Laravel\Prompts\password;

class UserController extends Controller

{


    public function userIndex()
    {
        return view('managements.users.index');
    }


    public function getUser()
    {
        return response()->json(User::with('department')->with('roles')->with('permissions')->paginate(1));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            "name" => ['required'],
            "email" => ['required'],
            "password" => ['required'],
        ]);

        if ($request->department_id != "") {
            $department_id = $request->department_id;
        } else {
            $department_id = 0;
        }
        $user = User::create([
            "department_id" => $department_id,
            'name' => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $user->syncPermissions($request->selected_permission);
        $user->syncRoles($request->selected_roles);


        return response()->json('success');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            "name" => ['required'],
            "email" => ['required'],
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Determine the department ID
        $department_id = $request->department_id != "" ? $request->department_id : 0;

        // Determine the password
        $password = $request->password === null ? $user->password : Hash::make($request->password);

        // Update the user record
        User::where('id', $id)->update([
            "department_id" => $department_id,
            'name' => $request->name,
            "email" => $request->email,
            "password" => $password
        ]);

        // Retrieve the updated user
        $updatedUser = User::findOrFail($id);

        // Sync permissions and roles
        $updatedUser->syncPermissions($request->selected_permission);
        $updatedUser->syncRoles($request->selected_roles);

        return response()->json('success');
    }

    public function deleteUser($id)
    {
        $user = User::findOrfail($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        Session::flash('success', 'Department created successfully');

        return back();
    }
}
