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
Route::get('/{name}', [ListingController::class,'index'])
->where('name', '(listings|)');

// Show form to create new listing
Route::get('/listings/create', [ListingController::class,'create']);

// Show form to edit listing
Route::get('/listings/{listing}/edit', [ListingController::class,'edit']);

// Edit form submission
Route::put('/listings/{listing}', [ListingController::class,'update']);

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class,'destroy']);

// Store listing
Route::post('/listings', [ListingController::class,'store']);

//Show single listing
Route::get('/listings/{listing}', [ListingController::class,'show']);

//Show register form
Route::get('/register', [UserController::class,'create']);

//Show login form
Route::get('/login', [UserController::class,'login']);

//Login form submission
Route::post('/users/authenticate', [UserController::class,'authenticate']); 

//Logout
Route::post('/logout', [UserController::class,'logout']);

Route::post('/users', [UserController::class,'store']);
