<?php

namespace App\Providers;

use App\Repositories\Organization\Contracts\OrganizationSearchRepositoryInterface;
use App\Repositories\Organization\OrganizationSearchRepository;
use App\Services\Organization\Contracts\OrganizationSearchServiceInterface;
use App\Services\Organization\OrganizationSearchService;
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
