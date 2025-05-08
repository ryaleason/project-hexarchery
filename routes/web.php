<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Hash;

// Public routes
Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');

// Authentication routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/auth', [AuthController::class, 'login'])->name('login.submit');
});

// Admin routes (protected by auth middleware)
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [ScheduleController::class, 'indexadmin'])->name('schedule.index');
    Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/create/submit', [ScheduleController::class, 'store'])->name('schedule.submit');
    Route::get('/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/{id}/edit/submit', [ScheduleController::class, 'update'])->name('schedule.update');
});

Route::get('/bycrep',function(){
    return Hash::make("12");
} );