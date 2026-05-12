<?php

namespace App\Services;

use App\Repositories\FacilityRepository;
use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @mixin FacilityRepository
 * @property FacilityRepository $repository
 */
class FacilityService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(FacilityRepository::class);
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
