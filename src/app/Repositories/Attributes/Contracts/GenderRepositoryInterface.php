<?php

namespace App\Repositories\Attributes\Contracts;

use Illuminate\Support\Collection;
use App\Models\Attributes\Gender;

interface GenderRepositoryInterface extends BaseAttributeRepositoryInterface
{
    public function findById(int $id): ?Gender;
    public function findByCode(?string $code): ?Gender;
}
