<?php

// app/Services/Facility/FacilitySearchService.php

namespace App\Services\Facility;

use App\Models\Facility;
use App\Repositories\Facility\Contracts\FacilitySearchRepositoryInterface;
use App\Services\Facility\Contracts\FacilitySearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FacilitySearchService implements FacilitySearchServiceInterface
{
    public function __construct(
        protected FacilitySearchRepositoryInterface $repository
    ) {
    }

    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        return $this->repository->search($filters, $perPage);
    }

    public function getById(int $id): ?Facility
    {
        return $this->repository->findById($id, ['organization']);
    }

    public function getByOrganization(int $organizationId, array $filters = []): Collection
    {
        return $this->repository->findByOrganization($organizationId, $filters);
    }

    public function getActiveByOrganization(int $organizationId): Collection
    {
        return $this->repository->findActiveByOrganization($organizationId);
    }

    public function getByCode(string $code): ?Facility
    {
        return $this->repository->findByCode($code);
    }

    public function validateUniqueName(int $organizationId, string $name, ?int $excludeId = null): bool
    {
        if ($excludeId) {
            return !Facility::forOrganization($organizationId)
                ->where('name', $name)
                ->where('id', '!=', $excludeId)
                ->exists();
        }

        return !$this->repository->existsForOrganization($organizationId, $name);
    }
}
