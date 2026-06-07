<?php

namespace App\Repositories\VitalSign\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VitalSignSearchRepositoryInterface
{
    public function search(
        ?string $search,
        int $page,
        array $filters
    ): LengthAwarePaginator;
}
