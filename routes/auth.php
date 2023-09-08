<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
These are all the routes for authorization and can be accessed with /auth
*/

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('/logout', [AuthController::class, "logout"]);
Route::post('/refresh', [AuthController::class, "refresh"]);
