<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('auth.logout');
Route::post('/forgot-password', [AuthController::class, 'sentPasswordResetLink'])->middleware('throttle:6,1')->name('auth.forgot-password');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::post('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum')->name('auth.user');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::apiResource('users', UserController::class);
});
