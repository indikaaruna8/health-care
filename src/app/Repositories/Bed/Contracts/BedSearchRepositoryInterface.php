<?php

// app/Repositories/Bed/Contracts/BedSearchRepositoryInterface.php

namespace App\Repositories\Bed\Contracts;

use App\Models\Bed;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BedSearchRepositoryInterface
{
    public function search(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function findById(int $id, array $with = []): ?Bed;
    public function findByWard(int $wardId): Collection;
    public function findAvailableByWard(int $wardId): Collection;
    public function findByWardAndNumber(int $wardId, string $bedNumber): ?Bed;
    public function existsInWard(int $wardId, string $bedNumber, ?int $excludeId = null): bool;
}
