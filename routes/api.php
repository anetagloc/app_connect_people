<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;


Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);

    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(base_path('routes/api/v1.php'));
