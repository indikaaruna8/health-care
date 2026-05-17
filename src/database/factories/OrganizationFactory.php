<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganizationFactory extends Factory
{
    protected $model = \App\Models\Organization::class;

    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => $this->faker->randomElement(['startup', 'sme', 'enterprise']),
            'registration_number' => 'REG' . $this->faker->numerify('##########'),
            'tax_id' => 'TAX' . $this->faker->numerify('#########'),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'plan' => $this->faker->randomElement(['free', 'basic', 'premium', 'enterprise']),
            'subscription_status' => $this->faker->randomElement(['trial', 'active', 'expired', 'canceled']),
            'trial_ends_at' => $this->faker->optional()->dateTimeBetween('now', '+30 days'),
            'logo' => $this->faker->optional()->imageUrl(),
            'timezone' => $this->faker->timezone(),
            'locale' => $this->faker->randomElement(['en', 'es', 'fr', 'de']),
            'owner_id' => \App\Models\User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
