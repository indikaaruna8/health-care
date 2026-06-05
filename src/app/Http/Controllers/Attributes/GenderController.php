<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GenderController extends Controller
{
    public function __construct(
        private \App\Services\Attributes\Contracts\GenderServiceInterface $genderService
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->genderService->active());
    }

    public function all(): JsonResponse
    {
        return response()->json($this->genderService->all());
    }

    public function enum(): JsonResponse
    {
        return response()->json($this->genderService->fromEnum());
    }

    public function show(int $id): JsonResponse
    {
        $gender = $this->genderService->findById($id);

        if (!$gender) {
            return response()->json(['message' => 'Gender not found'], 404);
        }

        return response()->json($gender);
    }
}
