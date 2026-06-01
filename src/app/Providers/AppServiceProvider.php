<?php

namespace App\Providers;

use App\Repositories\Organization\Contracts\OrganizationSearchRepositoryInterface;
use App\Repositories\Organization\OrganizationSearchRepository;
use App\Services\Organization\Contracts\OrganizationSearchServiceInterface;
use App\Services\Organization\OrganizationSearchService;
use App\Repositories\Organization\Contracts\OrganizationRepositoryInterface;
use App\Repositories\Organization\OrganizationRepository;
use App\Services\Organization\Contracts\OrganizationServiceInterface;
use App\Services\Organization\OrganizationService;
use App\Repositories\Facility\Contracts\FacilitySearchRepositoryInterface;
use App\Repositories\Facility\FacilitySearchRepository;
use App\Services\Facility\Contracts\FacilitySearchServiceInterface;
use App\Services\Facility\FacilitySearchService;
use App\Repositories\Facility\Contracts\FacilityRepositoryInterface;
use App\Repositories\Facility\FacilityRepository;
use App\Services\Facility\Contracts\FacilityServiceInterface;
use App\Services\Facility\FacilityService;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrganizationSearchRepositoryInterface::class, function ($app) {
            return new OrganizationSearchRepository();
        });

        $this->app->bind(OrganizationSearchServiceInterface::class, function ($app) {
            return new OrganizationSearchService();
        });


        $this->app->bind(FacilitySearchRepositoryInterface::class, FacilitySearchRepository::class);
        $this->app->bind(FacilitySearchServiceInterface::class, FacilitySearchService::class);
        $this->app->bind(
            \App\Repositories\Facility\Contracts\FacilitySearchRepositoryInterface::class,
            \App\Repositories\Facility\FacilitySearchRepository::class
        );
        $this->app->bind(
            \App\Services\Facility\Contracts\FacilitySearchServiceInterface::class,
            \App\Services\Facility\FacilitySearchService::class
        );
        // Write operations
        $this->app->bind(FacilityRepositoryInterface::class, FacilityRepository::class);
        $this->app->bind(FacilityServiceInterface::class, FacilityService::class);


        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(OrganizationServiceInterface::class, OrganizationService::class);

        // Facility Write
        $this->app->bind(\App\Repositories\Facility\Contracts\FacilityRepositoryInterface::class, \App\Repositories\Facility\FacilityRepository::class);
        $this->app->bind(\App\Services\Facility\Contracts\FacilityServiceInterface::class, \App\Services\Facility\FacilityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
