<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\employescontroller;
use App\Http\Controllers\departmentcontroller;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('api');

Route::middleware(['api'])->group(function () {



    /////////////////////////////////////// Department Requests /////////////////////////////////////////
    

    Route::apiResource('/department', departmentcontroller::class);
   
    Route::put('/department-restore/{department}', [departmentcontroller::class, 'departmentRestore']);
    Route::delete('/department-force-delete/{department}', [departmentcontroller::class, 'forceDelete']);

 
    

    
    //////////////////////////////////////// Employee Requests //////////////////////////////////////////
   

    Route::apiResource('/employee', employescontroller::class);
    
    Route::put('/employee-restore/{employee}', [employescontroller::class, 'employeeRestore']);
    Route::delete('/employee-force-delete/{employee}', [employescontroller::class, 'forceDelete']);

    
    

    
    

});
