<?php

// app/Services/Ward/Contracts/WardServiceInterface.php

namespace App\Services\Ward\Contracts;

use App\Models\Ward;

interface WardServiceInterface
{
    public function create(array $data): Ward;
    public function update(int $id, array $data): Ward;
    public function delete(int $id): bool;
}
