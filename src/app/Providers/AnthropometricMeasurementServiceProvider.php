<?php

namespace App\Providers;

use App\Repositories\AnthropometricMeasurement\AnthropometricMeasurementRepository;
use App\Repositories\AnthropometricMeasurement\Contracts\AnthropometricMeasurementRepositoryInterface;
use App\Services\AnthropometricMeasurement\AnthropometricMeasurementService;
use App\Services\AnthropometricMeasurement\Contracts\AnthropometricMeasurementServiceInterface;
use Illuminate\Support\ServiceProvider;

class AnthropometricMeasurementServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AnthropometricMeasurementRepositoryInterface::class,
            AnthropometricMeasurementRepository::class
        );

        $this->app->bind(
            AnthropometricMeasurementServiceInterface::class,
            AnthropometricMeasurementService::class
        );
    }
}
