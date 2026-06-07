<?php

namespace App\Services\VitalSign;

use App\Models\VitalSign;
use App\Repositories\VitalSign\Contracts\VitalSignRepositoryInterface;
use App\Services\VitalSign\Contracts\VitalSignServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VitalSignService implements VitalSignServiceInterface
{
    public function __construct(
        private VitalSignRepositoryInterface $repository
    ) {}

    public function create(array $data): VitalSign
    {
        $this->validateBusinessRules($data);

        return DB::transaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    public function update(int $id, array $data): VitalSign
    {
        $this->validateBusinessRules($data, $id);

        return DB::transaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }

    private function validateBusinessRules(array $data, ?int $excludeId = null): void
    {
        // Validate that diastolic BP is less than systolic BP when both are provided
        if (isset($data['systolic_bp'], $data['diastolic_bp'])) {
            if ($data['diastolic_bp'] >= $data['systolic_bp']) {
                throw ValidationException::withMessages([
                    'diastolic_bp' => ['Diastolic blood pressure must be less than systolic blood pressure.'],
                ]);
            }
        }

        // Validate that observation_at is not in the future
        if (isset($data['observation_at'])) {
            $observationAt = \DateTime::createFromFormat('Y-m-d H:i:s', $data['observation_at']);
            if ($observationAt && $observationAt > now()) {
                throw ValidationException::withMessages([
                    'observation_at' => ['Observation time cannot be in the future.'],
                ]);
            }
        }
    }
}
