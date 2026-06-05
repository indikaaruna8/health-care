<?php

// app/Repositories/Ward/WardRepository.php

namespace App\Repositories\Ward;

use App\Models\Ward;
use App\Repositories\Ward\Contracts\WardRepositoryInterface;

class WardRepository implements WardRepositoryInterface
{
    public function __construct(protected Ward $model)
    {
    }

    public function create(array $data): Ward
    {
        return $this->model->create($data);
    }

    public function update(Ward $ward, array $data): Ward
    {
        $ward->update($data);
        return $ward->fresh();
    }

    public function delete(Ward $ward): bool
    {
        return $ward->delete();
    }
}
