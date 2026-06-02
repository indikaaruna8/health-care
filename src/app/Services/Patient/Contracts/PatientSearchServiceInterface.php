<?php

// app/Services/Patient/Contracts/PatientSearchServiceInterface.php

namespace App\Services\Patient\Contracts;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PatientSearchServiceInterface
{
    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;

    public function getById(int $id): ?Patient;

    public function getByNhi(string $nhiNumber): ?Patient;

    public function getByFacility(int $facilityId, array $filters = []): Collection;

    public function getByFacilityAndNhi(int $facilityId, string $nhiNumber): ?Patient;

    public function validateUniqueNhi(string $nhiNumber, ?int $excludeId = null): bool;

    public function validateNhiInFacility(int $facilityId, string $nhiNumber, ?int $excludeId = null): bool;
}
