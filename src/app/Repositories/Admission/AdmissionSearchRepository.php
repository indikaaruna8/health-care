<?php

// app/Repositories/Admission/AdmissionSearchRepository.php

namespace App\Repositories\Admission;

use App\Models\Admission;
use App\Repositories\Admission\Contracts\AdmissionSearchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdmissionSearchRepository implements AdmissionSearchRepositoryInterface
{
    public function __construct(protected Admission $model)
    {
    }

    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = $this->model->newQuery()->with(['facility', 'patient', 'careAssignments']);

        $this->applyFilters($query, $filters);

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    public function findById(int $id, array $with = []): ?Admission
    {
        return $this->model->with($with)->find($id);
    }

    public function findByFacility(int $facilityId, array $filters = []): Collection
    {
        $query = $this->model->forFacility($facilityId);
        $this->applyFilters($query, $filters);
        return $query->get();
    }

    public function findActiveByFacility(int $facilityId): Collection
    {
        return $this->model->forFacility($facilityId)->active()->with('patient')->get();
    }

    public function findByPatient(int $patientId): Collection
    {
        return $this->model->forPatient($patientId)->with('facility')->get();
    }

    public function findActiveByPatient(int $patientId): ?Admission
    {
        return $this->model->forPatient($patientId)->active()->latest('admission_date')->first();
    }

    public function existsActiveForPatient(int $patientId): bool
    {
        return $this->model->forPatient($patientId)->active()->exists();
    }

    protected function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['facility_id'])) {
            $query->forFacility($filters['facility_id']);
        }
        if (!empty($filters['patient_id'])) {
            $query->forPatient($filters['patient_id']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['admission_date_from'])) {
            $query->whereDate('admission_date', '>=', $filters['admission_date_from']);
        }
        if (!empty($filters['admission_date_to'])) {
            $query->whereDate('admission_date', '<=', $filters['admission_date_to']);
        }
    }
}
