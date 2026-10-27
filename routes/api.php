<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\V2\ContactController as V2ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// v1 routes
Route::apiResource('contacts', ContactController::class)
    ->only(['index', 'store', 'show']);

// v2 routes
Route::prefix('v2')->name('v2.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::apiResource('contacts', V2ContactController::class)->only(['index', 'store', 'show']);
});
