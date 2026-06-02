<?php

namespace App\Repositories\Patient\Contracts;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PatientSearchRepositoryInterface
{
    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;

    public function findById(int $id, array $with = []): ?Patient;

    public function findByNhi(string $nhiNumber): ?Patient;

    public function findByFacility(int $facilityId, array $filters = []): Collection;

    public function findByFacilityAndNhi(int $facilityId, string $nhiNumber): ?Patient;

    public function existsByNhi(string $nhiNumber, ?int $excludeId = null): bool;

    public function existsInFacility(int $facilityId, string $nhiNumber): bool;
}
