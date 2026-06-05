<?php

namespace App\Services\Attributes\Contracts;

interface CountryServiceInterface
{
    public function all(): \Illuminate\Support\Collection;

    public function active(): \Illuminate\Support\Collection;

    public function findByCode(string $code): ?\App\Models\Attributes\Country;

    public function fromEnum(): array;

    public function enumToArray(): array;
}
