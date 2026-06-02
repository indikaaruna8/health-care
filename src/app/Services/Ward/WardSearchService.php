<?php

// app/Services/Ward/WardSearchService.php

namespace App\Services\Ward;

use App\Repositories\Ward\Contracts\WardSearchRepositoryInterface;
use App\Services\Ward\Contracts\WardSearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WardSearchService implements WardSearchServiceInterface
{
    public function __construct(protected WardSearchRepositoryInterface $repository)
    {
    }

    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        return $this->repository->search($filters, $perPage);
    }

    public function getById(int $id): ?\App\Models\Ward
    {
        return $this->repository->findById($id, ['facility', 'beds']);
    }

    public function getByFacility(int $facilityId): Collection
    {
        return $this->repository->findByFacility($facilityId);
    }

    public function validateUniqueName(int $facilityId, string $name, ?int $excludeId = null): bool
    {
        return !$this->repository->existsInFacility($facilityId, $name, $excludeId);
    }
}
