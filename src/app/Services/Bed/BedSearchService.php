<?php

// app/Services/Bed/BedSearchService.php

namespace App\Services\Bed;

use App\Repositories\Bed\Contracts\BedSearchRepositoryInterface;
use App\Services\Bed\Contracts\BedSearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BedSearchService implements BedSearchServiceInterface
{
    public function __construct(protected BedSearchRepositoryInterface $repository)
    {
    }

    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        return $this->repository->search($filters, $perPage);
    }

    public function getById(int $id): ?\App\Models\Bed
    {
        return $this->repository->findById($id, ['ward.facility']);
    }

    public function getByWard(int $wardId): Collection
    {
        return $this->repository->findByWard($wardId);
    }

    public function getAvailableByWard(int $wardId): Collection
    {
        return $this->repository->findAvailableByWard($wardId);
    }

    public function validateUniqueBedNumber(int $wardId, string $bedNumber, ?int $excludeId = null): bool
    {
        return !$this->repository->existsInWard($wardId, $bedNumber, $excludeId);
    }
}
