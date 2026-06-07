<?php

namespace App\Services\Attributes;

use App\Enums\Attributes\Gender as GenderEnum;
use App\Repositories\Attributes\Contracts\GenderRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Attributes\Gender;
use App\Services\Attributes\Contracts\GenderServiceInterface;

class GenderService implements GenderServiceInterface
{
    public function __construct(
        private GenderRepositoryInterface $genderRepository
    ) {
    }

    public function all(): Collection
    {
        return $this->genderRepository->all();
    }

    public function active(): Collection
    {
        return $this->genderRepository->active();
    }

    public function findById(int $id): ?Gender
    {
        return $this->genderRepository->findById($id);
    }

    public function findByCode(?string $code): ?Gender
    {
        return $this->genderRepository->findByCode($code);
    }

    public function fromEnum(): array
    {
        return GenderEnum::all();
    }

    public function enumToArray(): array
    {
        return GenderEnum::toArray();
    }
}
