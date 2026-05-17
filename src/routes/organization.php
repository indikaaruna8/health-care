<?php

use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\Organization\OrganizationIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('organization', [OrganizationIndexController::class, 'index'])->name('organization.index');
    Route::get('organization/search', [OrganizationIndexController::class, 'search'])->name('organization.search');
});
