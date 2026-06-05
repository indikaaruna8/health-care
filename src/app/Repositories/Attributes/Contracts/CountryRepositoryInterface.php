<?php

namespace App\Repositories\Attributes\Contracts;

use App\Models\Attributes\Country;

interface CountryRepositoryInterface extends BaseAttributeRepositoryInterface
{
    public function findByCode(string $code): ?Country;

    public function findByName(string $name): ?Country;
}
