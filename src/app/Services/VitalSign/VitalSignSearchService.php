<?php

namespace App\Services\VitalSign;

use App\Repositories\VitalSign\Contracts\VitalSignSearchRepositoryInterface;
use App\Services\VitalSign\Contracts\VitalSignSearchServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VitalSignSearchService implements VitalSignSearchServiceInterface
{
    public function __construct(
        private VitalSignSearchRepositoryInterface $searchRepository
    ) {}

    public function search(
        ?string $search,
        int $page,
        array $filters
    ): LengthAwarePaginator {
        return $this->searchRepository->search($search, $page, $filters);
    }
}
