<?php

namespace App\Http\Controllers\Facility;

use App\Http\Controllers\Controller;
use App\Http\Resources\Facility\FacilitiesCollectionResource;
use App\Http\Requests\Facility\CreateFacilityRequest;
use App\Http\Requests\Facility\DeleteFacilityRequest;
use App\Http\Requests\Facility\GetFacilityRequest;
use App\Http\Requests\Facility\SearchFacilitiesRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Http\Resources\Facility\FacilityResource;
use App\Services\FacilityService;
use Symfony\Component\HttpFoundation\Response;

class FacilityController extends Controller
{
    public function create(CreateFacilityRequest $request, FacilityService $service): FacilityResource
    {
        $data = $request->onlyValidated();

        $result = $service->create($data);

        return FacilityResource::make($result);
    }

    public function get(GetFacilityRequest $request, FacilityService $service, $id): FacilityResource
    {
        $result = $service
            ->with($request->input('with', []))
            ->withCount($request->input('with_count', []))
            ->find($id);

        return FacilityResource::make($result);
    }

    public function search(SearchFacilitiesRequest $request, FacilityService $service): FacilitiesCollectionResource
    {
        $result = $service->search($request->onlyValidated());

        return FacilitiesCollectionResource::make($result);
    }

    public function update(UpdateFacilityRequest $request, FacilityService $service, $id): Response
    {
        $service->update($id, $request->onlyValidated());

        return response()->noContent();
    }

    public function delete(DeleteFacilityRequest $request, FacilityService $service, $id): Response
    {
        $service->delete($id);

        return response()->noContent();
    }
}
