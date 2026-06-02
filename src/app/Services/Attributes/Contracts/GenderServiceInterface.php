<?php

namespace App\Services\Attributes\Contracts;

interface GenderServiceInterface
{
    public function all(): \Illuminate\Support\Collection;

    public function active(): \Illuminate\Support\Collection;

    public function findById(int $id): ?\App\Models\Attributes\Gender;

    public function findByCode(?string $code): ?\App\Models\Attributes\Gender;

    public function fromEnum(): array;

    public function enumToArray(): array;
}
