<?php

// app/Repositories/Patient/PatientSearchRepository.php

namespace App\Repositories\Patient;

use App\Models\Patient;
use App\Repositories\Patient\Contracts\PatientSearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PatientSearchRepository implements PatientSearchRepositoryInterface
{
    public function __construct(
        protected Patient $model
    ) {
    }

    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->with(['facility']);

        $this->applyFilters($query, $filters);

        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }

    public function findById(int $id, array $with = []): ?Patient
    {
        return $this->model->with($with)->find($id);
    }

    public function findByNhi(string $nhiNumber): ?Patient
    {
        return $this->model->byNhi($nhiNumber)->first();
    }

    public function findByFacility(int $facilityId, array $filters = []): Collection
    {
        $query = $this->model->forFacility($facilityId);

        $this->applyFilters($query, $filters);

        return $query->get();
    }

    public function findByFacilityAndNhi(int $facilityId, string $nhiNumber): ?Patient
    {
        return $this->model
            ->forFacility($facilityId)
            ->byNhi($nhiNumber)
            ->first();
    }

    public function existsByNhi(string $nhiNumber, ?int $excludeId = null): bool
    {
        $query = $this->model->byNhi($nhiNumber);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public function existsInFacility(int $facilityId, string $nhiNumber): bool
    {
        return $this->model
            ->forFacility($facilityId)
            ->byNhi($nhiNumber)
            ->exists();
    }

    protected function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['facility_id'])) {
            $query->forFacility($filters['facility_id']);
        }

        if (!empty($filters['nhi_number'])) {
            $query->byNhi($filters['nhi_number']);
        }

        if (!empty($filters['name'])) {
            $query->searchName($filters['name']);
        }

        if (!empty($filters['gender'])) {
            $query->byGender($filters['gender']);
        }

        if (!empty($filters['ethnicity'])) {
            $query->where('ethnicity', $filters['ethnicity']);
        }

        if (!empty($filters['date_of_birth_from'])) {
            $query->whereDate('date_of_birth', '>=', $filters['date_of_birth_from']);
        }

        if (!empty($filters['date_of_birth_to'])) {
            $query->whereDate('date_of_birth', '<=', $filters['date_of_birth_to']);
        }

        if (isset($filters['interpreter_required'])) {
            $query->where('interpreter_required', $filters['interpreter_required']);
        }

        if (!empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function (Builder $q) use ($search) {
                $q->where('first_name', 'like', $search)
                  ->orWhere('last_name', 'like', $search)
                  ->orWhere('preferred_name', 'like', $search)
                  ->orWhere('nhi_number', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('mobile_phone', 'like', $search);
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
