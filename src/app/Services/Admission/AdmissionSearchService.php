<?php

// app/Services/Admission/AdmissionSearchService.php

namespace App\Services\Admission;

use App\Repositories\Admission\Contracts\AdmissionSearchRepositoryInterface;
use App\Services\Admission\Contracts\AdmissionSearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AdmissionSearchService implements AdmissionSearchServiceInterface
{
    public function __construct(protected AdmissionSearchRepositoryInterface $repository)
    {
    }

    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        return $this->repository->search($filters, $perPage);
    }

    public function getById(int $id): ?\App\Models\Admission
    {
        return $this->repository->findById($id, ['facility', 'patient', 'careAssignments.levelOfCare', 'careAssignments.ward', 'careAssignments.bed']);
    }

    public function getByFacility(int $facilityId, array $filters = []): Collection
    {
        return $this->repository->findByFacility($facilityId, $filters);
    }

    public function getActiveByFacility(int $facilityId): Collection
    {
        return $this->repository->findActiveByFacility($facilityId);
    }

    public function getByPatient(int $patientId): Collection
    {
        return $this->repository->findByPatient($patientId);
    }

    public function getActiveByPatient(int $patientId): ?\App\Models\Admission
    {
        return $this->repository->findActiveByPatient($patientId);
    }

    public function hasActiveAdmission(int $patientId): bool
    {
        return $this->repository->existsActiveForPatient($patientId);
    }
}
