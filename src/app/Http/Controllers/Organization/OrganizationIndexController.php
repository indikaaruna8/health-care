<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\SearchOrganizationsRequest;
use App\Services\Organization\Contracts\OrganizationSearchServiceInterface;
use App\Traits\ApiResponder;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class OrganizationIndexController extends Controller
{
    use ApiResponder;

    public function __construct(
        private readonly OrganizationSearchServiceInterface $organizationService
    ) {
    }

    public function index(): InertiaResponse
    {
        return Inertia::render('organizations/index', []);
    }

    public function search(SearchOrganizationsRequest $request)
    {
        try {
            $data = $request->validated();

            $organizations = $this->organizationService->search(
                filters: $data,
                perPage: $data['per_page'] ?? config('search.default_page_size'),
            );

            return $this->respondWithPagination($organizations);
        } catch (\Exception $e) {
            return $this->respondError($e);
        }
    }
}
