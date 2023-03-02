<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DeductionController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users', [UserController::class, 'store']);
    Route::delete('users', [UserController::class, 'delete']);

    Route::resource('deduction', DeductionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance/create', [AttendanceController::class, 'store']);
    Route::resource('tax', TaxController::class);
    ROute::get('payroll', [PayrollController::class, 'index'])->name('payroll');
});