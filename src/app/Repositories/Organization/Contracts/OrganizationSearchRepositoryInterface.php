<?php

namespace App\Repositories\Organization\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrganizationSearchRepositoryInterface
{
    public function search(array $filters, int $perPage = 15): LengthAwarePaginator;
}
