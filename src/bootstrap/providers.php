<?php

use App\Providers\AnthropometricMeasurementServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\RepositoryServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    RepositoryServiceProvider::class,
    AnthropometricMeasurementServiceProvider::class,
];
