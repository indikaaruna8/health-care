<?php

// app/Repositories/LevelOfCare/LevelOfCareRepository.php

namespace App\Repositories\LevelOfCare;

use App\Models\LevelOfCare;
use App\Repositories\LevelOfCare\Contracts\LevelOfCareRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LevelOfCareRepository implements LevelOfCareRepositoryInterface
{
    public function __construct(protected LevelOfCare $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $id): ?LevelOfCare
    {
        return $this->model->find($id);
    }

    public function findByName(string $name): ?LevelOfCare
    {
        return $this->model->where('name', $name)->first();
    }

    public function create(array $data): LevelOfCare
    {
        return $this->model->create($data);
    }

    public function update(LevelOfCare $levelOfCare, array $data): LevelOfCare
    {
        $levelOfCare->update($data);
        return $levelOfCare->fresh();
    }

    public function delete(LevelOfCare $levelOfCare): bool
    {
        return $levelOfCare->delete();
    }
}
