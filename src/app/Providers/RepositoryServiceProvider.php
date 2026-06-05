<?php

namespace App\Providers;

use App\Repositories\Attributes\Contracts\CountryRepositoryInterface;
use App\Repositories\Attributes\Contracts\EthnicityRepositoryInterface;
use App\Repositories\Attributes\Contracts\GenderRepositoryInterface;
use App\Repositories\Attributes\CountryRepository;
use App\Repositories\Attributes\EthnicityRepository;
use App\Repositories\Attributes\GenderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, GenderRepository::class);
        $this->app->bind(EthnicityRepositoryInterface::class, EthnicityRepository::class);
    }
}
