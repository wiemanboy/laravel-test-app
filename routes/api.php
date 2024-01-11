<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TransactionController;
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

Route::get("/post/{id}", [PostController::class, "getPost"]);
Route::get('post', [PostController::class, "getPosts"]);


Route::group([

    'middleware' => 'auth:api',
    'prefix' => '/post'

], function ($router) {
    Route::post("/", [PostController::class, "createPost"]);
    Route::put("/{id}", [PostController::class, "updatePost"] );
    Route::delete("/{id}", [PostController::class, "deletePost"]);
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => '/comment'

], function ($router) {
    Route::post("/", [CommentController::class, "addComment"]);
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => '/transactions'

], function ($router) {
    Route::get("/", [TransactionController::class, "getTransactions"]);
});
