<?php

// app/Services/LevelOfCare/LevelOfCareService.php

namespace App\Services\LevelOfCare;

use App\Models\LevelOfCare;
use App\Repositories\LevelOfCare\Contracts\LevelOfCareRepositoryInterface;
use App\Services\LevelOfCare\Contracts\LevelOfCareServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class LevelOfCareService implements LevelOfCareServiceInterface
{
    public function __construct(protected LevelOfCareRepositoryInterface $repository)
    {
    }

    public function list(): Collection
    {
        return $this->repository->all();
    }

    public function getById(int $id): ?LevelOfCare
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): LevelOfCare
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): LevelOfCare
    {
        $levelOfCare = $this->repository->findById($id);
        if (!$levelOfCare) {
            throw new \RuntimeException('Level of care not found.');
        }
        return $this->repository->update($levelOfCare, $data);
    }

    public function delete(int $id): bool
    {
        $levelOfCare = $this->repository->findById($id);
        if (!$levelOfCare) {
            throw new \RuntimeException('Level of care not found.');
        }
        return $this->repository->delete($levelOfCare);
    }
}
