<?php

namespace App\Services\VitalSign\Contracts;

use App\Models\VitalSign;

interface VitalSignServiceInterface
{
    public function create(array $data): VitalSign;

    public function update(int $id, array $data): VitalSign;

    public function delete(int $id): bool;
}
