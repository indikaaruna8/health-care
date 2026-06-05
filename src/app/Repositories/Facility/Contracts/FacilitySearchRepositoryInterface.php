<?php

// app/Repositories/Facility/Contracts/FacilitySearchRepositoryInterface.php

namespace App\Repositories\Facility\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface FacilitySearchRepositoryInterface
{
    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;

    public function findById(int $id, array $with = []): ?\App\Models\Facility;

    public function findByOrganization(int $organizationId, array $filters = []): Collection;

    public function findActiveByOrganization(int $organizationId): Collection;

    public function findByCode(string $code): ?\App\Models\Facility;

    public function existsForOrganization(int $organizationId, string $name): bool;
}
