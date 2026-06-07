<?php

namespace App\Repositories\VitalSign\Contracts;

interface VitalSignRepositoryInterface
{
    public function create(array $data): VitalSign;

    public function update(int $id, array $data): VitalSign;

    public function delete(int $id): bool;

    public function findById(int $id): ?VitalSign;
}
