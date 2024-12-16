<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/absen', [App\Http\Controllers\AttendanceController::class, 'index'])->name('absen.index');
    Route::get('/absen/create', [App\Http\Controllers\AttendanceController::class, 'create'])->name('absen.create');
    Route::post('/absen/create', [App\Http\Controllers\AttendanceController::class, 'store'])->name('absen.store');
    Route::resource('activities', ActivityController::class);
    Route::put('activities/{activity}/status/{status}', [ActivityController::class, 'updateStatus'])->name('activities.updateStatus');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.updated');
});
