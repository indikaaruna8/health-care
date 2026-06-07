<?php

namespace App\Services\VitalSign\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VitalSignSearchServiceInterface
{
    public function search(
        ?string $search,
        int $page,
        array $filters
    ): LengthAwarePaginator;
}
