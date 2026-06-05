<?php

namespace App\Repositories\Attributes;

use App\Models\Attributes\Ethnicity;
use App\Repositories\Attributes\Contracts\EthnicityRepositoryInterface;
use Illuminate\Support\Collection;

class EthnicityRepository implements EthnicityRepositoryInterface
{
    public function all(): Collection
    {
        return Ethnicity::all();
    }

    public function active(): Collection
    {
        return Ethnicity::where('active', true)->get();
    }

    public function findById(int $id): ?Ethnicity
    {
        return Ethnicity::find($id);
    }

    public function findByCode(?string $code): ?Ethnicity
    {
        if ($code === null) {
            return null;
        }
        return Ethnicity::where('code', $code)->first();
    }
}
