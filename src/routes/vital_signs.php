<?php

use App\Http\Controllers\VitalSign\VitalSignController;
use App\Http\Controllers\VitalSign\VitalSignIndexController;
use Illuminate\Support\Facades\Route;

Route::prefix('vital-signs')->group(function () {
    // Read Routes
    Route::get('/', [VitalSignIndexController::class, 'index']);
    Route::get('/{id}', [VitalSignIndexController::class, 'show']);

    // Write Routes
    Route::post('/', [VitalSignController::class, 'store']);
    Route::put('/{id}', [VitalSignController::class, 'update']);
    Route::delete('/{id}', [VitalSignController::class, 'destroy']);
});
