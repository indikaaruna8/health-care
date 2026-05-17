<?php

namespace App\Services\Organization;

use App\Repositories\OrganizationRepository;
use App\Services\Organization\Contracts\OrganizationSearchServiceInterface;
use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @mixin OrganizationRepository
 * @property OrganizationRepository $repository
 */
class OrganizationSearchService extends EntityService implements OrganizationSearchServiceInterface
{
    public function __construct()
    {
        $this->setRepository(OrganizationRepository::class);
    }

    /**
     * Search organizations based on filters with pagination
     */
    public function search(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        // Add any business logic before searching
        $this->applyBusinessRules($filters);

        // Perform the search with pagination
        $organizations = $this->repository->search($filters, $perPage);

        // Add additional data to results if needed
        $this->enrichResults($organizations);

        return $organizations;
    }

    /**
     * Apply any business rules before searching
     */
    private function applyBusinessRules(array &$filters): void
    {
        // Example: If user is not admin, only show their organizations
        if (!auth()->user()?->isAdmin()) {
            $filters['owner_id'] = auth()->id();
        }
    }

    /**
     * Enrich results with additional data
     */
    private function enrichResults(LengthAwarePaginator $organizations): void
    {
        $organizations->getCollection()->transform(function ($organization) {
            // Add computed attributes
            $organization->subscription_status_text = $this->getStatusText($organization->subscription_status);

            if ($organization->subscription_status === 'trial' && $organization->trial_ends_at) {
                $organization->trial_days_remaining = now()->diffInDays($organization->trial_ends_at, false);
            }

            return $organization;
        });
    }

    private function getStatusText(string $status): string
    {
        return match($status) {
            'trial' => 'Trial Period',
            'active' => 'Active Subscription',
            'expired' => 'Subscription Expired',
            'canceled' => 'Subscription Canceled',
            default => ucfirst($status),
        };
    }
}
