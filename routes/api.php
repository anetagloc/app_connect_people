<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(base_path('routes/api/v1.php'));
