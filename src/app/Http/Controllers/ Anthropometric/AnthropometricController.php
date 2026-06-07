<?php

namespace App\Http\Controllers\Anthropometric;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anthropometric\AnthropometricRequest;
use App\Services\AnthropometricMeasurement\Contracts\AnthropometricMeasurementServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AnthropometricController extends Controller
{
    public function __construct(
        private readonly AnthropometricMeasurementServiceInterface $service
    ) {}

    public function index(int $admissionId): JsonResponse
    {
        $measurements = $this->service->getByAdmission($admissionId);

        return response()->json($measurements);
    }

    public function store(AnthropometricRequest $request): JsonResponse
    {
        $measurement = $this->service->createMeasurement($request->validated());

        return response()->json($measurement, Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $measurement = $this->service->getById($id);

        if (! $measurement) {
            return response()->json(['message' => 'Measurement not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($measurement);
    }

    public function update(AnthropometricRequest $request, int $id): JsonResponse
    {
        $measurement = $this->service->updateMeasurement($id, $request->validated());

        return response()->json($measurement);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->deleteMeasurement($id);

        if (! $deleted) {
            return response()->json(['message' => 'Measurement not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
