<?php

// app/Services/LevelOfCare/Contracts/LevelOfCareServiceInterface.php

namespace App\Services\LevelOfCare\Contracts;

use App\Models\LevelOfCare;
use Illuminate\Database\Eloquent\Collection;

interface LevelOfCareServiceInterface
{
    public function list(): Collection;
    public function getById(int $id): ?LevelOfCare;
    public function create(array $data): LevelOfCare;
    public function update(int $id, array $data): LevelOfCare;
    public function delete(int $id): bool;
}
