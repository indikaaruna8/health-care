<?php

// app/Services/Bed/Contracts/BedSearchServiceInterface.php

namespace App\Services\Bed\Contracts;

use App\Models\Bed;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BedSearchServiceInterface
{
    public function list(array $filters = [], ?int $perPage = null): LengthAwarePaginator|Collection;
    public function getById(int $id): ?Bed;
    public function getByWard(int $wardId): Collection;
    public function getAvailableByWard(int $wardId): Collection;
    public function validateUniqueBedNumber(int $wardId, string $bedNumber, ?int $excludeId = null): bool;
}
