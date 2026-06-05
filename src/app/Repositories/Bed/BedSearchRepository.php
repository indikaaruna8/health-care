<?php

// app/Repositories/Bed/BedSearchRepository.php

namespace App\Repositories\Bed;

use App\Models\Bed;
use App\Repositories\Bed\Contracts\BedSearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BedSearchRepository implements BedSearchRepositoryInterface
{
    public function __construct(protected Bed $model)
    {
    }

    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->with(['ward.facility']);

        if (!empty($filters['ward_id'])) {
            $query->where('ward_id', $filters['ward_id']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['facility_id'])) {
            $query->whereHas('ward', fn ($q) => $q->where('facility_id', $filters['facility_id']));
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    public function findById(int $id, array $with = []): ?Bed
    {
        return $this->model->with($with)->find($id);
    }

    public function findByWard(int $wardId): Collection
    {
        return $this->model->where('ward_id', $wardId)->get();
    }

    public function findAvailableByWard(int $wardId): Collection
    {
        return $this->model->where('ward_id', $wardId)->where('status', 'available')->get();
    }

    public function findByWardAndNumber(int $wardId, string $bedNumber): ?Bed
    {
        return $this->model->where('ward_id', $wardId)->where('bed_number', $bedNumber)->first();
    }

    public function existsInWard(int $wardId, string $bedNumber, ?int $excludeId = null): bool
    {
        $query = $this->model->where('ward_id', $wardId)->where('bed_number', $bedNumber);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
