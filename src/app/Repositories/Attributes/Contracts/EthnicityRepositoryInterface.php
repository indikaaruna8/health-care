<?php

namespace App\Repositories\Attributes\Contracts;

use App\Models\Attributes\Ethnicity;
use Illuminate\Support\Collection;

interface EthnicityRepositoryInterface extends BaseAttributeRepositoryInterface
{
    public function findById(int $id): ?Ethnicity;
    public function findByCode(?string $code): ?Ethnicity;
}
