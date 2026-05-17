<?php

namespace App\Repositories;

use App\Models\Organization;
use RonasIT\Support\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property Organization $model
 */
class OrganizationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Organization::class);
    }

    /**
     * Search organizations with filters and pagination
     */
    public function search(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        // Apply search filter (search in multiple fields)
        if (!empty($filters['search'])) {
            $searchTerm = '%' . $filters['search'] . '%';
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('slug', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orWhere('registration_number', 'LIKE', $searchTerm)
                    ->orWhere('tax_id', 'LIKE', $searchTerm)
                    ->orWhere('phone', 'LIKE', $searchTerm);
            });
        }

        // Apply exact match filters
        $this->applyFilter($query, 'type', $filters);
        $this->applyFilter($query, 'plan', $filters);
        $this->applyFilter($query, 'subscription_status', $filters);
        $this->applyFilter($query, 'country', $filters);
        $this->applyFilter($query, 'city', $filters);
        $this->applyFilter($query, 'owner_id', $filters);

        // Apply date range filters
        if (!empty($filters['created_from'])) {
            $query->whereDate('created_at', '>=', $filters['created_from']);
        }

        if (!empty($filters['created_to'])) {
            $query->whereDate('created_at', '<=', $filters['created_to']);
        }

        // Filter by trial status
        if (!empty($filters['on_trial'])) {
            $query->where('subscription_status', 'trial')
                  ->where('trial_ends_at', '>', now());
        }

        // Filter by active subscription
        if (!empty($filters['active_subscription'])) {
            $query->whereIn('subscription_status', ['trial', 'active']);
        }

        // Apply sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';
        $query->orderBy($sortBy, $sortDirection);

        // Return paginated results
        return $query->paginate($perPage);
    }

    /**
     * Apply a simple equality filter
     */
    private function applyFilter(Builder $query, string $field, array $filters): void
    {
        if (!empty($filters[$field])) {
            $query->where($field, $filters[$field]);
        }
    }


    /**
     * Get all organizations with basic pagination (no filters)
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get organizations by owner
     */
    public function getByOwner(int $ownerId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('owner_id', $ownerId)
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Get organizations with expired trials
     */
    public function getExpiredTrials(): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('subscription_status', 'trial')
            ->where('trial_ends_at', '<', now())
            ->paginate(20);
    }

}
