<?php

// app/Services/Ward/Contracts/WardSearchServiceInterface.php

namespace App\Services\Ward\Contracts;

use App\Models\Ward;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface WardSearchServiceInterface
{
    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function getById(int $id): ?Ward;
    public function getByFacility(int $facilityId): Collection;
    public function validateUniqueName(int $facilityId, string $name, ?int $excludeId = null): bool;
}
