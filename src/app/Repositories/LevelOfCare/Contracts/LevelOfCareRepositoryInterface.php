<?php

// app/Repositories/LevelOfCare/Contracts/LevelOfCareRepositoryInterface.php

namespace App\Repositories\LevelOfCare\Contracts;

use App\Models\LevelOfCare;
use Illuminate\Database\Eloquent\Collection;

interface LevelOfCareRepositoryInterface
{
    public function all(): Collection;
    public function findById(int $id): ?LevelOfCare;
    public function findByName(string $name): ?LevelOfCare;
    public function create(array $data): LevelOfCare;
    public function update(LevelOfCare $levelOfCare, array $data): LevelOfCare;
    public function delete(LevelOfCare $levelOfCare): bool;
}
