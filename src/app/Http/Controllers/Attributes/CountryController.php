<?php

namespace App\Http\Controllers\Attributes;

use App\Http\Controllers\Controller;
use App\Services\Attibutes\App\Services\Attributes\Contracts\CountryServiceInterface as CountryService;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function __construct(
        private CountryService $countryService
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->countryService->active());
    }

    public function all(): JsonResponse
    {
        return response()->json($this->countryService->all());
    }

    public function enum(): JsonResponse
    {
        return response()->json($this->countryService->fromEnum());
    }

    public function show(string $code): JsonResponse
    {
        $country = $this->countryService->findByCode($code);

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        return response()->json($country);
    }
}
