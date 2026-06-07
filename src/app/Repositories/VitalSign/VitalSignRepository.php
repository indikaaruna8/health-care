<?php

namespace App\Repositories\VitalSign;

use App\Models\VitalSign;
use App\Repositories\VitalSign\Contracts\VitalSignRepositoryInterface;

class VitalSignRepository implements VitalSignRepositoryInterface
{
    public function __construct(
        private VitalSign $model
    ) {}

    public function create(array $data): VitalSign
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): VitalSign
    {
        $vitalSign = $this->model->findOrFail($id);
        $vitalSign->update($data);

        return $vitalSign->fresh();
    }

    public function delete(int $id): bool
    {
        $vitalSign = $this->model->findOrFail($id);

        return $vitalSign->delete();
    }

    public function findById(int $id): ?VitalSign
    {
        return $this->model->find($id);
    }
}
