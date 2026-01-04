<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressData\AddressDataController;
use App\Models\AdressData;

Route::prefix('address')->group(function () {
    Route::get('/', [AddressDataController::class, 'index']);
});
