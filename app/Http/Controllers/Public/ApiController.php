<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllDepartments(){
       return response()->json( Department::all());
    }
    public function getAllRoles(){
        return response()->json( Role::all());
     }
     
     public function getAllPermissions(){
        return response()->json( Permission::all());
     }
}
