<?php

namespace App\Services\Organization\Contracts;

interface OrganizationSearchServiceInterface
{
    public function search(array $filters, int $perPage = 15);
}
