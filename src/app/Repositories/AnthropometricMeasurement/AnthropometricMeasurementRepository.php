<?php

namespace App\Repositories\AnthropometricMeasurement;

use App\Models\AnthropometricMeasurement;
use App\Repositories\AnthropometricMeasurement\Contracts\AnthropometricMeasurementRepositoryInterface;
use Illuminate\Support\Collection;

class AnthropometricMeasurementRepository implements AnthropometricMeasurementRepositoryInterface
{
    public function __construct(
        private readonly AnthropometricMeasurement $model
    ) {
    }

    public function find(int $id): ?AnthropometricMeasurement
    {
        return $this->model->find($id);
    }

    public function findByAdmission(int $admissionId): Collection
    {
        return $this->model
            ->where('admission_id', $admissionId)
            ->orderBy('measured_at', 'desc')
            ->get();
    }

    public function create(array $data): AnthropometricMeasurement
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): AnthropometricMeasurement
    {
        $measurement = $this->model->findOrFail($id);
        $measurement->update($data);

        return $measurement->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
