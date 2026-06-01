<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\OrganizationsCollectionResource;
use App\Http\Requests\Organization\DeleteOrganizationRequest;
use App\Http\Requests\Organization\GetOrganizationRequest;
use App\Http\Requests\Organization\SearchOrganizationsRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Http\Requests\Organization\CreateOrganizationRequest ;
use App\Http\Resources\Organization\OrganizationResource;
use App\Services\Organization\OrganizationService;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class OrganizationController extends Controller
{
    public function create(): InertiaResponse
    {
        return Inertia::render('organizations/create');
    }

    public function store(CreateOrganizationRequest $request, OrganizationService $service): OrganizationResource
    {
        $data = $request->onlyValidated();

        $result = $service->create($data);

        return OrganizationResource::make($result);
    }

    public function get(GetOrganizationRequest $request, OrganizationService $service, $id): OrganizationResource
    {
        $result = $service
            ->with($request->input('with', []))
            ->withCount($request->input('with_count', []))
            ->find($id);

        return OrganizationResource::make($result);
    }

    public function search(SearchOrganizationsRequest $request, OrganizationService $service): OrganizationsCollectionResource
    {
        $result = $service->search($request->onlyValidated());

        return OrganizationsCollectionResource::make($result);
    }

    public function update(UpdateOrganizationRequest $request, OrganizationService $service, $id): Response
    {
        $service->update($id, $request->onlyValidated());

        return response()->noContent();
    }

    public function delete(DeleteOrganizationRequest $request, OrganizationService $service, $id): Response
    {
        $service->delete($id);

        return response()->noContent();
    }
}
