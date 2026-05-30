<?php

use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\Organization\OrganizationIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('organizations', [OrganizationIndexController::class, 'index'])
        ->name('organizations.index');

    Route::get('organizations/search', [OrganizationIndexController::class, 'search'])
        ->name('organizations.search');

    Route::resource('organizations', OrganizationController::class)
    ->except(['show' , 'index'])->names([
        'create' => 'organizations.create',
        'store' => 'organizations.store',
        'edit' => 'organizations.edit',
        'update' => 'organizations.update',
        'destroy' => 'organizations.delete',
    ]);
});
