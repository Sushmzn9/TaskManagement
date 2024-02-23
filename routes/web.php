<?php

use App\Http\Controllers\Public\DepartmentContoller;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\UserController;
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




Route::get('roles/index', function () {
    return view('managements.roles.index');
})->name('roles.index');



Route::get('permission/index', function () {
    return view('managements.permissions.index');
})->name('permission.index');
