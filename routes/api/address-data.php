<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressData\AddressDataController;
use App\Http\Controllers\Location\LocationController;
use App\Models\AdressData;
use App\Models\Location;

Route::prefix('address')->group(function () {
    Route::get('/', [AddressDataController::class, 'index']);
    Route::post('/{cep}', [AddressDataController::class, 'store']);
    Route::put('/{id}', [AddressDataController::class, 'update']);
    Route::delete('/{id}', [AddressDataController::class, 'destroy']);
    Route::get('/{id}', [AddressDataController::class, 'show']);
    Route::patch('/{id}', [AddressDataController::class, 'restore']);
});

Route::prefix('location')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::get('/{id}', [LocationController::class, 'show']);
});
