<?php

namespace App\Services;

use App\Enums\Attributes\Ethnicity as EthnicityEnum;
use App\Repositories\Attributes\Contracts\EthnicityRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Attributes\Ethnicity;

class EthnicityService implements Contracts\EthnicityServiceInterface
{
    public function __construct(
        private EthnicityRepositoryInterface $ethnicityRepository
    ) {
    }

    public function all(): Collection
    {
        return $this->ethnicityRepository->all();
    }

    public function active(): Collection
    {
        return $this->ethnicityRepository->active();
    }

    public function findById(int $id): ?Ethnicity
    {
        return $this->ethnicityRepository->findById($id);
    }

    public function findByCode(?string $code): ?Ethnicity
    {
        return $this->ethnicityRepository->findByCode($code);
    }

    public function fromEnum(): array
    {
        return EthnicityEnum::all();
    }

    public function enumToArray(): array
    {
        return EthnicityEnum::toArray();
    }
}
