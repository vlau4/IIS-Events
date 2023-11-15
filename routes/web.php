<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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


Auth::routes();

// __________ JUST ADMIN _______________________________________________________________________________

Route::middleware(['auth', 'user-role:admin'])->group(function() {
    // Show Home Page for Admin
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('home.admin');
    
    // Manage Users
    Route::get('/users/manage', [UserController::class, 'manage']);
    
});

// __________ JUST MANAGER _____________________________________________________________________________

Route::middleware(['auth', 'user-role:manager'])->group(function() {
    // Show Home Page for Manager
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('home.manager');

});

// __________ JUST USER ________________________________________________________________________________

Route::middleware(['auth', 'user-role:user'])->group(function() {
    // Show Home Page for User
    Route::get('/user/home', [HomeController::class, 'userHome'])->name('home.user');
});

// __________ ADMIN AND MANAGER ________________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager'])->group(function() {
    
    // Show Confirm Section
    Route::get('/events/confirm', [EventController::class, 'showConfirm']);

    // Confirm New Events Created by Users
    Route::post('/events/{event}/confirmation', [EventController::class, 'confirm']);
});

// __________ ADMIN, MANAGER AND USER __________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager|user'])->group(function() {
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');

    // Show Create Form
    Route::get('/events/create', [EventController::class, 'create']);

    // Store Event Data
    Route::post('/events', [EventController::class, 'store']);

    // Show Edit Form
    Route::get('/events/{event}/edit', [EventController::class, 'edit']);

    // Manage Events
    Route::get('/events/manage', [EventController::class, 'manage']);

    // Update Event
    Route::put('/events/{event}', [EventController::class, 'update']);

    // Delete Event
    Route::delete('/events/{event}', [EventController::class, 'destroy']);
});

// __________ EVERYONE _________________________________________________________________________________

// All events
Route::get('/', [EventController::class, 'index']);

// Single Event
Route::get('/events/{event}', [EventController::class, 'show']);
