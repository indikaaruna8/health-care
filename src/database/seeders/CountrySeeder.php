<?php

namespace Database\Seeders;

use App\Enums\Country;
use App\Models\Country as CountryModel;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();

        foreach ($countries as $country) {
            CountryModel::firstOrCreate(
                ['code' => $country['code']],
                [
                    'name' => $country['name'],
                    'active' => $country['active'],
                ]
            );
        }
    }
}
