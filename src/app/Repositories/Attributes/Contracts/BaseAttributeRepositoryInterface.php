<?php

namespace App\Repositories\Attributes\Contracts;

use Illuminate\Support\Collection;

interface BaseAttributeRepositoryInterface
{
    public function all(): Collection;
    public function active(): Collection;
}
