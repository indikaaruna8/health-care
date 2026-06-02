<?php

namespace App\Services\Attributes\Contracts;

interface EthnicityServiceInterface
{
    public function all(): \Illuminate\Support\Collection;

    public function active(): \Illuminate\Support\Collection;

    public function findById(int $id): ?\App\Models\Attributes\Ethnicity;

    public function findByCode(?string $code): ?\App\Models\Attributes\Ethnicity;

    public function fromEnum(): array;

    public function enumToArray(): array;
}
