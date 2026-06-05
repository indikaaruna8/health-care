<?php

namespace App\Repositories\Attributes;

use App\Models\Attributes\Country;
use App\Repositories\Attributes\Contracts\CountryRepositoryInterface;
use Illuminate\Support\Collection;

class CountryRepository implements CountryRepositoryInterface
{
    public function all(): Collection
    {
        return Country::all();
    }

    public function active(): Collection
    {
        return Country::where('active', true)->get();
    }

    public function findByCode(string $code): ?Country
    {
        return Country::where('code', $code)->first();
    }

    public function findByName(string $name): ?Country
    {
        return Country::where('name', 'like', "%{$name}%")->first();
    }
}
