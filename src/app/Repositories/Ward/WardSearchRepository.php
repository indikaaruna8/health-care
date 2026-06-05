<?php

// app/Repositories/Ward/WardSearchRepository.php

namespace App\Repositories\Ward;

use App\Models\Ward;
use App\Repositories\Ward\Contracts\WardSearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class WardSearchRepository implements WardSearchRepositoryInterface
{
    public function __construct(protected Ward $model)
    {
    }

    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->with(['facility', 'beds']);

        if (!empty($filters['facility_id'])) {
            $query->where('facility_id', $filters['facility_id']);
        }
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    public function findById(int $id, array $with = []): ?Ward
    {
        return $this->model->with($with)->find($id);
    }

    public function findByFacility(int $facilityId): Collection
    {
        return $this->model->where('facility_id', $facilityId)->with('beds')->get();
    }

    public function findByFacilityAndName(int $facilityId, string $name): ?Ward
    {
        return $this->model->where('facility_id', $facilityId)->where('name', $name)->first();
    }

    public function existsInFacility(int $facilityId, string $name, ?int $excludeId = null): bool
    {
        $query = $this->model->where('facility_id', $facilityId)->where('name', $name);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
