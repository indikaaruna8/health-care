<?php

namespace App\Services;

use App\Repositories\OrganizationRepository;
use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @mixin OrganizationRepository
 * @property OrganizationRepository $repository
 */
class OrganizationService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(OrganizationRepository::class);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        return $this
            ->with(Arr::get($filters, 'with', []))
            ->withCount(Arr::get($filters, 'with_count', []))
            ->searchQuery($filters)
            ->getSearchResults();
    }
}
