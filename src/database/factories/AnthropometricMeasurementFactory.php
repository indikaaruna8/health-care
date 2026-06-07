<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\AnthropometricMeasurement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnthropometricMeasurementFactory extends Factory
{
    protected $model = AnthropometricMeasurement::class;

    public function definition(): array
    {
        $heightCm = fake()->randomFloat(2, 140, 200);
        $weightKg = fake()->randomFloat(2, 40, 150);
        $heightM = $heightCm / 100;
        $bmi = round($weightKg / ($heightM * $heightM), 2);

        return [
            'admission_id' => Admission::factory(),
            'weight_kg' => $weightKg,
            'height_cm' => $heightCm,
            'bmi' => $bmi,
            'measured_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
