<?php

// app/Services/Patient/PatientSearchService.php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Repositories\Patient\Contracts\PatientSearchRepositoryInterface;
use App\Services\Patient\Contracts\PatientSearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PatientSearchService implements PatientSearchServiceInterface
{
    public function __construct(
        protected PatientSearchRepositoryInterface $repository
    ) {
    }

    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection
    {
        return $this->repository->search($filters, $perPage);
    }

    public function getById(int $id): ?Patient
    {
        return $this->repository->findById($id, ['facility']);
    }

    public function getByNhi(string $nhiNumber): ?Patient
    {
        return $this->repository->findByNhi($nhiNumber);
    }

    public function getByFacility(int $facilityId, array $filters = []): Collection
    {
        return $this->repository->findByFacility($facilityId, $filters);
    }

    public function getByFacilityAndNhi(int $facilityId, string $nhiNumber): ?Patient
    {
        return $this->repository->findByFacilityAndNhi($facilityId, $nhiNumber);
    }

    public function validateUniqueNhi(string $nhiNumber, ?int $excludeId = null): bool
    {
        return !$this->repository->existsByNhi($nhiNumber, $excludeId);
    }

    public function validateNhiInFacility(int $facilityId, string $nhiNumber, ?int $excludeId = null): bool
    {
        if ($excludeId) {
            return !Patient::forFacility($facilityId)
                ->byNhi($nhiNumber)
                ->where('id', '!=', $excludeId)
                ->exists();
        }

        return !$this->repository->existsInFacility($facilityId, $nhiNumber);
    }
}
