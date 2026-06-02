<?php

// app/Repositories/Bed/Contracts/BedRepositoryInterface.php

namespace App\Repositories\Bed\Contracts;

use App\Models\Bed;

interface BedRepositoryInterface
{
    public function create(array $data): Bed;
    public function update(Bed $bed, array $data): Bed;
    public function updateStatus(Bed $bed, string $status): Bed;
    public function delete(Bed $bed): bool;
}
