<?php

namespace App\Providers;

use App\Repositories\VitalSign\Contracts\VitalSignRepositoryInterface;
use App\Repositories\VitalSign\Contracts\VitalSignSearchRepositoryInterface;
use App\Repositories\VitalSign\VitalSignRepository;
use App\Repositories\VitalSign\VitalSignSearchRepository;
use App\Services\VitalSign\Contracts\VitalSignServiceInterface;
use App\Services\VitalSign\Contracts\VitalSignSearchServiceInterface;
use App\Services\VitalSign\VitalSignService;
use App\Services\VitalSign\VitalSignSearchService;
use Illuminate\Support\ServiceProvider;

class VitalSignServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(VitalSignRepositoryInterface::class, VitalSignRepository::class);
        $this->app->bind(VitalSignSearchRepositoryInterface::class, VitalSignSearchRepository::class);

        // Service Bindings
        $this->app->bind(VitalSignServiceInterface::class, VitalSignService::class);
        $this->app->bind(VitalSignSearchServiceInterface::class, VitalSignSearchService::class);
    }

    public function boot(): void
    {
        //
    }
}
