<?php

// app/Services/Bed/BedService.php

namespace App\Services\Bed;

use App\Models\Bed;
use App\Repositories\Bed\Contracts\BedRepositoryInterface;
use App\Services\Bed\Contracts\BedServiceInterface;

class BedService implements BedServiceInterface
{
    public function __construct(protected BedRepositoryInterface $repository)
    {
    }

    public function create(array $data): Bed
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Bed
    {
        $bed = Bed::findOrFail($id);
        return $this->repository->update($bed, $data);
    }

    public function updateStatus(int $id, string $status): Bed
    {
        $bed = Bed::findOrFail($id);
        return $this->repository->updateStatus($bed, $status);
    }

    public function delete(int $id): bool
    {
        $bed = Bed::findOrFail($id);
        return $this->repository->delete($bed);
    }
}
