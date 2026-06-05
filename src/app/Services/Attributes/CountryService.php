<?php

namespace App\Services\Attributes;

use App\Enums\Attributes\Country as CountryEnum;
use App\Repositories\Attributes\Contracts\CountryRepositoryInterface;
use Illuminate\Support\Collection;

class CountryService implements Contracts\CountryServiceInterface
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository
    ) {
    }

    public function all(): Collection
    {
        return $this->countryRepository->all();
    }

    public function active(): Collection
    {
        return $this->countryRepository->active();
    }

    public function findByCode(string $code): ?\App\Models\Attributes\Country
    {
        return $this->countryRepository->findByCode($code);
    }

    public function fromEnum(): array
    {
        return CountryEnum::all();
    }

    public function enumToArray(): array
    {
        return CountryEnum::toArray();
    }
}
