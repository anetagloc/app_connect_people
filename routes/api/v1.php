<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ActivityController;
use App\Http\Controllers\API\V1\AvaibleTimeController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\EventController;
use App\Http\Controllers\API\V1\SuggestedActivityController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\Auth\UserController;

Route::apiResource('activities', ActivityController::class);
Route::apiResource('avaible-times', AvaibleTimeController::class);
Route::apiResource('categories', CategoryController::class)->except(['index']);
Route::apiResource('events', EventController::class);
Route::apiResource('suggested-activities', SuggestedActivityController::class);

Route::get('/user', UserController::class);
Route::post('/logout', LogoutController::class);