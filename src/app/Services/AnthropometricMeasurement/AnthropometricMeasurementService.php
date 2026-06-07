<?php

namespace App\Services\AnthropometricMeasurement;

use App\Models\AnthropometricMeasurement;
use App\Repositories\AnthropometricMeasurement\Contracts\AnthropometricMeasurementRepositoryInterface;
use App\Services\AnthropometricMeasurement\Contracts\AnthropometricMeasurementServiceInterface;
use Illuminate\Support\Collection;

class AnthropometricMeasurementService implements AnthropometricMeasurementServiceInterface
{
    public function __construct(
        private readonly AnthropometricMeasurementRepositoryInterface $repository
    ) {
    }

    public function getById(int $id): ?AnthropometricMeasurement
    {
        return $this->repository->find($id);
    }

    public function getByAdmission(int $admissionId): Collection
    {
        return $this->repository->findByAdmission($admissionId);
    }

    public function createMeasurement(array $data): AnthropometricMeasurement
    {
        return $this->repository->create($data);
    }

    public function updateMeasurement(int $id, array $data): AnthropometricMeasurement
    {
        return $this->repository->update($id, $data);
    }

    public function deleteMeasurement(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }
}
