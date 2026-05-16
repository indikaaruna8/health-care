<?php

use App\Http\Controllers\Organization\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('organization', '/organization/list');
    Route::get('organization/list', [OrganizationController::class, 'index'])->name('organization.index');
});



