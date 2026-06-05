<?php

// app/Repositories/Admission/Contracts/AdmissionSearchRepositoryInterface.php

namespace App\Repositories\Admission\Contracts;

use App\Models\Admission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AdmissionSearchRepositoryInterface
{
    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function findById(int $id, array $with = []): ?Admission;
    public function findByFacility(int $facilityId, array $filters = []): Collection;
    public function findActiveByFacility(int $facilityId): Collection;
    public function findByPatient(int $patientId): Collection;
    public function findActiveByPatient(int $patientId): ?Admission;
    public function existsActiveForPatient(int $patientId): bool;
}
c