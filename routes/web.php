<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserRouteController;

use App\Http\Controllers\AdminRouteController;

use App\Http\Controllers\CommonRouteController;

use App\Http\Controllers\ChangePasswordController;

use App\Http\Controllers\UpdateProfileController;

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
    return view('index');
});

Auth::routes();

// Common Routes
Route::get('dashboard', [CommonRouteController::class, 'index']) -> name('home');
Route::get('profile', [CommonRouteController::class, 'profile']) -> name('profile');
Route::get('edit-profile', [CommonRouteController::class, 'profile_edit']) -> name('profile_edit');
Route::get('change-password', [CommonRouteController::class, 'password']) -> name('password');
Route::post('change-password', [ChangePasswordController::class, 'store']) -> name('change.password');
Route::post('edit-profile', [UpdateProfileController::class, 'store']) -> name('profile_update');

// User Only Routes
Route::group(['middleware' => 'role:user'], function () {
    Route::get('register-sale', [UserRouteController::class, 'registerSale']) -> name('register-sale');
    Route::get('verify-info', [UserRouteController::class, 'verifyInfo']) -> name('verify-info');
    Route::get('your-entries', [UserRouteController::class, 'user_entries']) -> name('user_entries');
    Route::get('edit/{id}', [UserRouteController::class, 'edit_entry']) -> name('edit_entry');
});

// Admin Only Routes
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('manage_users', [AdminRouteController::class, 'manage_users']) -> name('manage-users');
    Route::get('add_user', [AdminRouteController::class, 'add_user']) -> name('add_user');
    Route::post('add_user', [AdminRouteController::class, 'user_add']) -> name('user_add');
    Route::get('manage_users/{id}', [AdminRouteController::class, 'edit_user']);
    Route::post('manage_users/{id}', [AdminRouteController::class, 'update_user']) -> name('update_user');
    Route::delete('manage_users/{id}', [AdminRouteController::class, 'delete_user']);
    Route::get('search', [AdminRouteController::class, 'search'])->name('search');
});