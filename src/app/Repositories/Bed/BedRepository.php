<?php

// app/Repositories/Bed/BedRepository.php

namespace App\Repositories\Bed;

use App\Models\Bed;
use App\Repositories\Bed\Contracts\BedRepositoryInterface;

class BedRepository implements BedRepositoryInterface
{
    public function __construct(protected Bed $model)
    {
    }

    public function create(array $data): Bed
    {
        return $this->model->create($data);
    }

    public function update(Bed $bed, array $data): Bed
    {
        $bed->update($data);
        return $bed->fresh();
    }

    public function updateStatus(Bed $bed, string $status): Bed
    {
        $bed->update(['status' => $status]);
        return $bed->fresh();
    }

    public function delete(Bed $bed): bool
    {
        return $bed->delete();
    }
}
