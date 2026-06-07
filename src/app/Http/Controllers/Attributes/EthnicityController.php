<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use App\Services\Attributes\Contracts\EthnicityServiceInterface as EthnicityService;
use Illuminate\Http\JsonResponse;

class EthnicityController extends Controller
{
    public function __construct(
        private EthnicityService $ethnicityService
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->ethnicityService->active());
    }

    public function all(): JsonResponse
    {
        return response()->json($this->ethnicityService->all());
    }

    public function enum(): JsonResponse
    {
        return response()->json($this->ethnicityService->fromEnum());
    }

    public function show(int $id): JsonResponse
    {
        $ethnicity = $this->ethnicityService->findById($id);

        if (!$ethnicity) {
            return response()->json(['message' => 'Ethnicity not found'], 404);
        }

        return response()->json($ethnicity);
    }
}
