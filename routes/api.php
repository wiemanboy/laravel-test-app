<?php

use App\Http\Controllers\TestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("test", [TestController::class, "createTest"]);

Route::get("/test/{id}", [TestController::class, "getTest"]);

Route::put("test/{id}", [TestController::class, "updateTest"]);

Route::delete("test/{id}", [TestController::class, "deleteTest"]);

Route::post("test/{id}", [TestController::class, "addComment"]);
