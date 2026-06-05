<?php

// app/Services/Bed/Contracts/BedServiceInterface.php

namespace App\Services\Bed\Contracts;

use App\Models\Bed;

interface BedServiceInterface
{
    public function create(array $data): Bed;
    public function update(int $id, array $data): Bed;
    public function updateStatus(int $id, string $status): Bed;
    public function delete(int $id): bool;
}
