<?php

namespace App\Repositories\Attributes;

use App\Models\Attributes\Gender;
use App\Repositories\Attributes\Contracts\GenderRepositoryInterface;
use Illuminate\Support\Collection;

class GenderRepository implements GenderRepositoryInterface
{
    public function all(): Collection
    {
        return Gender::all();
    }

    public function active(): Collection
    {
        return Gender::where('active', true)->get();
    }

    public function findById(int $id): ?Gender
    {
        return Gender::find($id);
    }

    public function findByCode(?string $code): ?Gender
    {
        if ($code === null) {
            return null;
        }
        return Gender::where('code', $code)->first();
    }
}
