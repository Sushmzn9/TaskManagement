<?php

use App\Http\Controllers\Public\DepartmentContoller;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PermissionController;
use App\Http\Controllers\Public\RoleController;
use App\Http\Controllers\Public\UserController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'dashboardIndex'])->name('dashboard.index');

Route::get('departments/index', [DepartmentContoller::class, 'departmentIndex'])->name('departments.index');
Route::get('departments/create', [DepartmentContoller::class, 'departmentCreate'])->name('departments.create');
Route::post('departments/store', [DepartmentContoller::class, 'departmentStore'])->name('departments.store');
Route::get('departments/edit/{id}', [DepartmentContoller::class, 'departmentEdit'])->name('departments.edit');
Route::patch('departments/update/{id}', [DepartmentContoller::class, 'departmentUpdate'])->name('departments.update');
Route::delete('departments/delete/{id}', [DepartmentContoller::class, 'departmentDelete'])->name('departments.delete');


Route::get('users/index', [UserController::class, 'userIndex'])->name('users.index');




Route::get('roles/index', [RoleController::class, "rolesIndex"])->name('roles.index');
Route::get('roles/create', [RoleController::class, "rolesCreate"])->name('roles.create');
Route::post('roles/store', [RoleController::class, "rolesStore"])->name('roles.store');
Route::get('roles/edit/{id}', [RoleController::class, "rolesEdit"])->name('roles.edit');
Route::post('roles/update/{id}', [RoleController::class, 'rolesUpdate'])->name('roles.update');
Route::delete('roles/delete/{id}', [RoleController::class, 'rolesdelete'])->name('roles.delete');




Route::get('permission/index', [PermissionController::class, "permissionIndex"])->name('permission.index');
Route::get('permission/create', [PermissionController::class, "permissionCreate"])->name('permission.create');
Route::post('permission/store', [PermissionController::class, "permissionStore"])->name('permission.store');
Route::get('permission/edit/{id}', [PermissionController::class, "permissionEdit"])->name('permission.edit');
Route::post('permission/update/{id}', [PermissionController::class, "permissionUpdate"])->name('permission.update');
Route::delete('permission/delete/{id}', [PermissionController::class, 'permissiondelete'])->name('permission.delete');
