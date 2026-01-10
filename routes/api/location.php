<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Location\LocationController;
use App\Models\Location;

Route::prefix('location')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
    Route::put('/{id}', [LocationController::class, 'update']);
});
