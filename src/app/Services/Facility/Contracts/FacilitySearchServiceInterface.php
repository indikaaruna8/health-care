<?php

// app/Services/Facility/Contracts/FacilitySearchServiceInterface.php

namespace App\Services\Facility\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface FacilitySearchServiceInterface
{
    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;

    public function getById(int $id): ?\App\Models\Facility;

    public function getByOrganization(int $organizationId, array $filters = []): Collection;

    public function getActiveByOrganization(int $organizationId): Collection;

    public function getByCode(string $code): ?\App\Models\Facility;

    public function validateUniqueName(int $organizationId, string $name, ?int $excludeId = null): bool;
}
