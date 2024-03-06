<?php

use App\Http\Controllers\Public\ApiController;
use App\Http\Controllers\Public\DepartmentContoller;
use App\Http\Controllers\Public\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/storeDepartment', [DepartmentContoller::class, 'storeDepartment']);
Route::get('/getDepartments', [DepartmentContoller::class, 'getDepartments']);
Route::post('/updateDepartment/{id}', [DepartmentContoller::class, 'updateDepartment']);
Route::post('/deleteDepartment/{id}', [DepartmentContoller::class, 'deleteDepartment']);

Route::get('/getAllDepartments', [ApiController::class, 'getAllDepartments']);
Route::get('/getAllRoles', [ApiController::class, 'getAllRoles']);
Route::get('/getAllPermissions', [ApiController::class, 'getAllPermissions']);
Route::get('/getAllUsers', [ApiController::class, 'getAllUsers']);


Route::post('/storeUser',[UserController::class, 'storeUser']);
Route::get('/getUser',[UserController::class,"getUser"]);
Route::post('/postUser/{id}', [UserController::class, 'updateUser']);
Route::post('/deleteUser/{id}',[UserController::class,"deleteUser"]);


Route::controller(TaskController::class)->group(function() {
    Route::post('storeTask', "storeTask");
    Route::get('getTask', 'getTask');
});