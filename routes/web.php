<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;

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

    // Show Manage Users
    Route::get('/users', [UserController::class, 'manage']);
    
    // Change User Role
    Route::put('/users/{user}', [UserController::class, 'change']);
});

// __________ ADMIN AND MANAGER ________________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager'])->group(function() {
    
    // Show Event Confirm Section
    Route::get('/events/confirm', [EventController::class, 'showConfirm']);

    // Show Category Confirm Section
    Route::get('/categories/confirm', [CategoryController::class, 'showConfirm']);

    // Show Location Confirm Section
    Route::get('/locations/confirm', [LocationController::class, 'showConfirm']);

    // Confirm New Event Created by User
    Route::post('/events/{event}/confirmation', [EventController::class, 'confirm']);

    // Confirm New Categorie Created by User
    Route::post('/categories/{category}/confirmation', [CategoryController::class, 'confirm']);

    // Confirm New Location Created by User
    Route::post('/locations/{location}/confirmation', [LocationController::class, 'confirm']);

    // Unconfirm New Event Created by User
    Route::delete('/events/{event}/unconfirm', [EventController::class, 'unconfirm'])->name('event.unconfirm');

    // Unconfirm New Categorie Created by User
    Route::delete('/categories/{category}/unconfirm', [CategoryController::class, 'unconfirm'])->name('category.unconfirm');

    // Unconfirm New Location Created by User
    Route::delete('/locations/{location}/unconfirm', [LocationController::class, 'unconfirm'])->name('location.unconfirm');
});

// __________ ADMIN, MANAGER AND USER __________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager|user'])->group(function() {

    // Show Create Form
    Route::get('/events/create', [EventController::class, 'create']);

    // Store Event Data
    Route::post('/events', [EventController::class, 'store']);

    // Show Edit Form
    Route::get('/events/{event}/edit', [EventController::class, 'edit']);

    // Add To My Events
    Route::put('/add/{event}', [EventController::class, 'add']);

    // Manage Events
    Route::get('/events/manage', [EventController::class, 'manage']);

    //Show My Events
    Route::get('/events/mine', [EventController::class, 'showMyEvents']);

    // Update Event
    Route::put('/events/{event}', [EventController::class, 'update']);

    // Delete Event
    Route::delete('/events/{event}', [EventController::class, 'destroy']);

    // Show All events
    Route::get('/categories', [CategoryController::class, 'show']);

    // Show Create Form
    Route::get('/categories/create', [CategoryController::class, 'create']);

    // Store Event Data
    Route::post('/categories', [CategoryController::class, 'store']);

    // Show All events
    Route::get('/locations', [LocationController::class, 'show']);

    // Show Create Form
    Route::get('/locations/create', [LocationController::class, 'create']);

    // Store Event Data
    Route::post('/locations', [LocationController::class, 'store']);

    // Store Comment
    Route::post('/events/{event}/comments', [CommentController::class, 'store']);
});

// __________ EVERYONE _________________________________________________________________________________

// Show All events
Route::get('/', [EventController::class, 'index']);

// Show Single Event
Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');