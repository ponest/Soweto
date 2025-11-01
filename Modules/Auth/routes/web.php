<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\RolesController;
use Modules\Auth\Http\Controllers\UsersController;

//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::resource('auths', AuthController::class)->names('auth');
//});

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('change-pass', [AuthController::class, 'changePasswordView'])->name('change-pass');
Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UsersController::class)->except('show', 'destroy');
    Route::get('users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('users/reset/{id}', [UsersController::class, 'reset'])->name('users.reset');

    Route::resource('roles', RolesController::class)->except('show', 'destroy');
    Route::get('roles/destroy/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');
});
