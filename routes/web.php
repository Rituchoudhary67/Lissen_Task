<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

//instead of this we can use the below one
// use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect('/users'); // logged in → go to user list
//     }
//     return redirect('/login'); // not logged in → go to login page
// });

// this one
Route::get('/', [MainController::class, 'showRegister']);

//registration route
Route::get('register', [MainController::class, 'showRegister']);
Route::post('register', [MainController::class, 'register']);

//login route
Route::get('login', [MainController::class, 'showLogin'])->name('login');
Route::post('login', [MainController::class, 'login']);

//logout route
Route::get('logout', [MainController::class, 'logout']);

//user list [protected by auth middleware]
Route::get('users', [MainController::class, 'users'])->middleware('auth');

