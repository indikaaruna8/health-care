<?php

namespace App\Http\Controllers\VitalSign;

use App\Http\Controllers\Controller;
use App\Http\Requests\VitalSign\SearchVitalSignRequest;
use App\Services\VitalSign\Contracts\VitalSignSearchServiceInterface;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class VitalSignIndexController extends Controller
{
    use ApiResponder;

    public function __construct(
        private VitalSignSearchServiceInterface $searchService
    ) {}

    public function index(SearchVitalSignRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $vitalSigns = $this->searchService->search(
            search: $validated['search'] ?? null,
            page: $validated['page'] ?? 1,
            filters: [
                'admission_id' => $validated['admission_id'] ?? null,
                'encounter_id' => $validated['encounter_id'] ?? null,
                'date_from' => $validated['date_from'] ?? null,
                'date_to' => $validated['date_to'] ?? null,
                'recorded_by' => $validated['recorded_by'] ?? null,
            ]
        );

        return $this->successResponse(
            data: $vitalSigns,
            message: 'Vital signs retrieved successfully.'
        );
    }

    public function show(int $id): JsonResponse
    {
        $vitalSign = $this->searchService->search(
            search: null,
            page: 1,
            filters: ['id' => $id]
        )->first();

        if (!$vitalSign) {
            return $this->errorResponse(
                message: 'Vital sign not found.',
                code: 404
            );
        }

        return $this->successResponse(
            data: $vitalSign,
            message: 'Vital sign retrieved successfully.'
        );
    }
}
