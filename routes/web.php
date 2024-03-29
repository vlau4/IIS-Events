<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AttendingController;

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
    Route::get('/users', [UserController::class, 'manage'])->name('users');
    
    // Change User Role
    Route::put('/users/{user}', [UserController::class, 'change'])->name('user');

    // Destroy Accounts
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});

// __________ ADMIN AND MANAGER ________________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager'])->group(function() {

    // Show Event Confirm Section
    Route::get('/confirm', [EventController::class, 'showConfirm'])->name('confirm');

    // Confirm New Event Created by User
    Route::post('/events/{event}/confirm', [EventController::class, 'confirm'])->name('event.confirm');

    // Unconfirm New Event Created by User
    Route::delete('/events/{event}/unconfirm', [EventController::class, 'unconfirm'])->name('event.unconfirm');

    // Confirm New Category Created by User
    Route::post('/categories/{category}/confirm', [CategoryController::class, 'confirm'])->name('category.confirm');

     // Unconfirm New Category Created by User
     Route::delete('/categories/{category}/unconfirm', [CategoryController::class, 'unconfirm'])->name('category.unconfirm');

    // Confirm New Location Created by User
    Route::post('/locations/{location}/confirm', [LocationController::class, 'confirm'])->name('location.confirm');

    // Unconfirm New Location Created by User
    Route::delete('/locations/{location}/unconfirm', [LocationController::class, 'unconfirm'])->name('location.unconfirm');

    // Delete Existing Event
    Route::delete('/events/{event}/delete', [EventController::class, 'delete'])->name('event.delete');

    // Delete Existing Category
    Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');

    // Delete Existing Location
    Route::delete('/locations/{location}/delete', [LocationController::class, 'delete'])->name('location.delete');

    // Manage Categories
    Route::get('/categories/manage', [CategoryController::class, 'manage'])->name('categories.manage');

    // Show Category Edit Form
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');

    // Update Category
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');

    // Manage Locations
    Route::get('/locations/manage', [LocationController::class, 'manage'])->name('locations.manage');

    // Show Location Edit Form
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('location.edit');

    // Update Location
    Route::put('/locations/{location}', [LocationController::class, 'update'])->name('location.update');
});

// __________ ADMIN, MANAGER AND USER __________________________________________________________________

Route::middleware(['auth', 'user-role:admin|manager|user'])->group(function() {

        // Settings
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');

        // Delete Your Account
        Route::delete('/delete', [UserController::class, 'delete'])->name('delete');

    // Show Event Create Form
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');

    // Store Event Data
    Route::post('/events', [EventController::class, 'store'])->name('event.store');

    // Show Event Edit Form
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('event.edit');

    // Add To My Events
    Route::post('/add/{event}', [EventController::class, 'add'])->name('event.add');

    // Remove From My Events
    Route::post('/remove/{event}', [EventController::class, 'remove'])->name('event.remove');

    // Manage Events
    Route::get('/events/manage', [EventController::class, 'manage'])->name('events.manage');

    // Manage Event Payments
    Route::get('/events/{event}/payments', [EventController::class, 'payments'])->name('event.payments');

    // Confirm User Payment
    Route::post('/events/{attending}', [AttendingController::class, 'confirm'])->name('payments.confirm');

    // Remove From My Events
    Route::delete('/events/{event}/attending/remove', [AttendingController::class, 'remove'])->name('attending.remove');

    //Show My Events
    Route::get('/events/mine', [EventController::class, 'showMyEvents'])->name('events.mine');

    // Update Event
    Route::put('/events/{event}', [EventController::class, 'update'])->name('event.update');

    // Delete Event
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('event.destroy');

    // Show Category Create Form
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');

    // Store Category Data
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

    // Show Location Create Form
    Route::get('/locations/create', [LocationController::class, 'create'])->name('location.create');

    // Store Location Data
    Route::post('/locations', [LocationController::class, 'store'])->name('location.store');

    // Store Comment
    Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('comment.store');

    // Delete Comment
    Route::delete('/{comment}', [CommentController::class, 'delete'])->name('comment.delete');
});

// __________ EVERYONE _________________________________________________________________________________

// Show All events
Route::get('/', [EventController::class, 'index'])->name('home');

// Show Single Event
Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');