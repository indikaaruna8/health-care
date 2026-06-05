<?php

// app/Repositories/Facility/FacilitySearchRepository.php

namespace App\Repositories\Facility;

use App\Models\Facility;
use App\Repositories\Facility\Contracts\FacilitySearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FacilitySearchRepository implements FacilitySearchRepositoryInterface
{
    public function __construct(
        protected Facility $model
    ) {
    }

    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->with(['organization']);

        $this->applyFilters($query, $filters);

        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }

    public function findById(int $id, array $with = []): ?Facility
    {
        return $this->model->with($with)->find($id);
    }

    public function findByOrganization(int $organizationId, array $filters = []): Collection
    {
        $query = $this->model->forOrganization($organizationId);

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    public function findActiveByOrganization(int $organizationId): Collection
    {
        return $this->model
            ->forOrganization($organizationId)
            ->active()
            ->get();
    }

    public function findByCode(string $code): ?Facility
    {
        return $this->model->where('code', $code)->first();
    }

    public function existsForOrganization(int $organizationId, string $name): bool
    {
        return $this->model
            ->forOrganization($organizationId)
            ->where('name', $name)
            ->exists();
    }

    protected function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['organization_id'])) {
            $query->forOrganization($filters['organization_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['type'])) {
            $query->byType($filters['type']);
        }

        if (!empty($filters['city'])) {
            $query->where('city', 'like', '%' . $filters['city'] . '%');
        }

        if (!empty($filters['state'])) {
            $query->where('state', $filters['state']);
        }

        if (isset($filters['is_primary'])) {
            $query->where('is_primary', $filters['is_primary']);
        }

        if (!empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('code', 'like', $search)
                  ->orWhere('address', 'like', $search)
                  ->orWhere('email', 'like', $search);
            });
        }

        if (!empty($filters['sort_by'])) {
            $direction = $filters['sort_direction'] ?? 'asc';
            $query->orderBy($filters['sort_by'], $direction);
        } else {
            $query->latest();
        }
    }
}
