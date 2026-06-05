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
use App\Repositories\Patient\Contracts\PatientRepositoryInterface;
use App\Repositories\Patient\Contracts\PatientSearchRepositoryInterface;
use App\Repositories\Patient\PatientRepository;
use App\Repositories\Patient\PatientSearchRepository;
use App\Services\Patient\Contracts\PatientServiceInterface;
use App\Services\Patient\Contracts\PatientSearchServiceInterface;
use App\Services\Patient\PatientService;
use App\Services\Patient\PatientSearchService;
use App\Repositories\Admission\Contracts\AdmissionRepositoryInterface;
use App\Repositories\Admission\Contracts\AdmissionSearchRepositoryInterface;
use App\Repositories\Admission\AdmissionRepository;
use App\Repositories\Admission\AdmissionSearchRepository;
use App\Repositories\Bed\Contracts\BedRepositoryInterface;
use App\Repositories\Bed\Contracts\BedSearchRepositoryInterface;
use App\Repositories\Bed\BedRepository;
use App\Repositories\Bed\BedSearchRepository;
use App\Repositories\LevelOfCare\Contracts\LevelOfCareRepositoryInterface;
use App\Repositories\LevelOfCare\LevelOfCareRepository;
use App\Repositories\PatientCareAssignment\Contracts\PatientCareAssignmentRepositoryInterface;
use App\Repositories\PatientCareAssignment\PatientCareAssignmentRepository;
use App\Repositories\Ward\Contracts\WardRepositoryInterface;
use App\Repositories\Ward\Contracts\WardSearchRepositoryInterface;
use App\Repositories\Ward\WardRepository;
use App\Repositories\Ward\WardSearchRepository;
use App\Services\Admission\Contracts\AdmissionSearchServiceInterface;
use App\Services\Admission\Contracts\AdmissionServiceInterface;
use App\Services\Admission\AdmissionSearchService;
use App\Services\Admission\AdmissionService;
use App\Services\Bed\Contracts\BedSearchServiceInterface;
use App\Services\Bed\Contracts\BedServiceInterface;
use App\Services\Bed\BedSearchService;
use App\Services\Bed\BedService;
use App\Services\LevelOfCare\Contracts\LevelOfCareServiceInterface;
use App\Services\LevelOfCare\LevelOfCareService;
use App\Services\PatientCareAssignment\Contracts\PatientCareAssignmentServiceInterface;
use App\Services\PatientCareAssignment\PatientCareAssignmentService;
use App\Services\Ward\Contracts\WardSearchServiceInterface;
use App\Services\Ward\Contracts\WardServiceInterface;
use App\Services\Ward\WardSearchService;
use App\Services\Ward\WardService;
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

        $this->app->bind(PatientSearchRepositoryInterface::class, PatientSearchRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(PatientSearchServiceInterface::class, PatientSearchService::class);
        $this->app->bind(PatientServiceInterface::class, PatientService::class);

        $this->app->bind(LevelOfCareRepositoryInterface::class, LevelOfCareRepository::class);
        $this->app->bind(LevelOfCareServiceInterface::class, LevelOfCareService::class);

        $this->app->bind(WardSearchRepositoryInterface::class, WardSearchRepository::class);
        $this->app->bind(WardRepositoryInterface::class, WardRepository::class);
        $this->app->bind(WardSearchServiceInterface::class, WardSearchService::class);
        $this->app->bind(WardServiceInterface::class, WardService::class);

        $this->app->bind(BedSearchRepositoryInterface::class, BedSearchRepository::class);
        $this->app->bind(BedRepositoryInterface::class, BedRepository::class);
        $this->app->bind(BedSearchServiceInterface::class, BedSearchService::class);
        $this->app->bind(BedServiceInterface::class, BedService::class);

        $this->app->bind(AdmissionSearchRepositoryInterface::class, AdmissionSearchRepository::class);
        $this->app->bind(AdmissionRepositoryInterface::class, AdmissionRepository::class);
        $this->app->bind(AdmissionSearchServiceInterface::class, AdmissionSearchService::class);
        $this->app->bind(AdmissionServiceInterface::class, AdmissionService::class);

        $this->app->bind(PatientCareAssignmentRepositoryInterface::class, PatientCareAssignmentRepository::class);
        $this->app->bind(PatientCareAssignmentServiceInterface::class, PatientCareAssignmentService::class);
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
