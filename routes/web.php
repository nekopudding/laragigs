<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// Show all listings
Route::get('/', [ListingController::class,'index']);

// Show form to create new listing
Route::get('/listings/create', [ListingController::class,'create'])
->middleware('auth');

// Show form to edit listing
Route::get('/listings/{listing}/edit', [ListingController::class,'edit'])
->middleware('auth');

// Edit form submission
Route::put('/listings/{listing}', [ListingController::class,'update'])
->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class,'destroy'])
->middleware('auth');

// Store listing
Route::post('/listings', [ListingController::class,'store']);

//Show single listing
Route::get('/listings/{listing}', [ListingController::class,'show']);

//Show register form
Route::get('/register', [UserController::class,'create'])
->middleware('guest'); //redirects to home if user is logged in

//Show login form
Route::get('/login', [UserController::class,'login'])->name('login')
->middleware('guest'); //redirects to home if user is logged in

//Login form submission
Route::post('/users/authenticate', [UserController::class,'authenticate']); 

//Logout
Route::post('/logout', [UserController::class,'logout'])
->middleware('auth');

// Store new user
Route::post('/users', [UserController::class,'store']);
