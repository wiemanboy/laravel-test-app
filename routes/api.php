<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => '/auth'

], function ($router) {

    Route::post('/register', [AuthController::class, "register"]);
    Route::post('/login', [AuthController::class, "login"]);
    Route::post('/logout', [AuthController::class, "logout"]);
    Route::post('/refresh', [AuthController::class, "refresh"]);
    Route::post('/me', [AuthController::class, "me"]);
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => '/post'

], function ($router) {
    Route::post("/", [PostController::class, "createPost"]);
    Route::get("/{id}", [PostController::class, "getPost"]);
    Route::put("/{id}", [PostController::class, "updatePost"]);
    Route::delete("/{id}", [PostController::class, "deletePost"]);
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => '/comment'

], function ($router) {
    Route::post("/", [CommentController::class, "addComment"]);
});
