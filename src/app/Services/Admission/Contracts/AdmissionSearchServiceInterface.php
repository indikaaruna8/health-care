<?php

// app/Services/Admission/Contracts/AdmissionSearchServiceInterface.php

namespace App\Services\Admission\Contracts;

use App\Models\Admission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AdmissionSearchServiceInterface
{
    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function getById(int $id): ?Admission;
    public function getByFacility(int $facilityId, array $filters = []): Collection;
    public function getActiveByFacility(int $facilityId): Collection;
    public function getByPatient(int $patientId): Collection;
    public function getActiveByPatient(int $patientId): ?Admission;
    public function hasActiveAdmission(int $patientId): bool;
}
