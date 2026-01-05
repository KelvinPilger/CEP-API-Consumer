<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressData\AddressDataController;
use App\Models\AdressData;

Route::prefix('address')->group(function () {
    Route::get('/', [AddressDataController::class, 'index']);
    Route::post('/{cep}', [AddressDataController::class, 'store']);
    Route::put('/{id}', [AddressDataController::class, 'update']);
    Route::delete('/{id}', [AddressDataController::class, 'destroy']);
});
