<?php

namespace App\Services\AnthropometricMeasurement\Contracts;

use App\Models\AnthropometricMeasurement;
use Illuminate\Support\Collection;

interface AnthropometricMeasurementServiceInterface
{
    public function getById(int $id): ?AnthropometricMeasurement;

    public function getByAdmission(int $admissionId): Collection;

    public function createMeasurement(array $data): AnthropometricMeasurement;

    public function updateMeasurement(int $id, array $data): AnthropometricMeasurement;

    public function deleteMeasurement(int $id): bool;

    public function getAll(): Collection;
}
