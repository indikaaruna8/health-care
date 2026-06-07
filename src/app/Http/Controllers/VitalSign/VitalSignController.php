<?php

namespace App\Http\Controllers\VitalSign;

use App\Http\Controllers\Controller;
use App\Http\Requests\VitalSign\StoreVitalSignRequest;
use App\Http\Requests\VitalSign\UpdateVitalSignRequest;
use App\Services\VitalSign\Contracts\VitalSignServiceInterface;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class VitalSignController extends Controller
{
    use ApiResponder;

    public function __construct(
        private VitalSignServiceInterface $service
    ) {}

    public function store(StoreVitalSignRequest $request): JsonResponse
    {
        $vitalSign = $this->service->create($request->validated());

        return $this->successResponse(
            data: $vitalSign,
            message: 'Vital sign recorded successfully.',
            code: 201
        );
    }

    public function update(UpdateVitalSignRequest $request, int $id): JsonResponse
    {
        $vitalSign = $this->service->update($id, $request->validated());

        return $this->successResponse(
            data: $vitalSign,
            message: 'Vital sign updated successfully.'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return $this->successResponse(
            message: 'Vital sign deleted successfully.'
        );
    }
}
