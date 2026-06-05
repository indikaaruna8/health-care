<?php

// app/Repositories/Ward/Contracts/WardSearchRepositoryInterface.php

namespace App\Repositories\Ward\Contracts;

use App\Models\Ward;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface WardSearchRepositoryInterface
{
    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function findById(int $id, array $with = []): ?Ward;
    public function findByFacility(int $facilityId): Collection;
    public function findByFacilityAndName(int $facilityId, string $name): ?Ward;
    public function existsInFacility(int $facilityId, string $name, ?int $excludeId = null): bool;
}
