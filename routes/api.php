<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('products', 'ProductController')
->middleware("auth:sanctum");

Route::apiResource('categories', 'CategoryController')
->middleware("auth:sanctum");

Route::post("sanctum/token", "UserTokenController");

Route::post("/newsletter", "NewsletterController@send");

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('newsletter', [\App\Http\Controllers\NewsletterController::class, 'send'])->name('send.newsletter');

    Route::post('products/{product}/rate', [\App\Http\Controllers\ProductRatingController::class, 'rate']);

    Route::post('products/{product}/unrate', [\App\Http\Controllers\ProductRatingController::class, 'unrate']);

    Route::post("rating/{rating}/approve", "ProductRatingController@approve");

    Route::get("rating", "ProductRatingController@list");
    
});

Route::get('/server-error', function () {
    abort(500, "Error 500");
});