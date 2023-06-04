<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function() {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo','bar');
});

Route::get('/posts/{id}', function($id) {
    // dd($id); //die and dump the id
    ddd($id); //die, dump, and debug
    return response('Post ' . $id, 200);
})->where('id', '[0-9]+'); //limit route to only accept numbers

Route::get('/search', function(Request $request) {
    // dd($request);
    //get the query parameters
    return $request->name . ' ' . $request->age;
});