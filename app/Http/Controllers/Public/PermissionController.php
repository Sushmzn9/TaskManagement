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
   public function permissionCreate(){
    return view('managements.permissions.create');
}

}
