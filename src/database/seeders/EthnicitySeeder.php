<?php

namespace Database\Seeders;

use App\Enums\Ethnicity;
use App\Models\Ethnicity as EthnicityModel;
use Illuminate\Database\Seeder;

class EthnicitySeeder extends Seeder
{
    public function run(): void
    {
        $ethnicities = Ethnicity::all();

        foreach ($ethnicities as $ethnicity) {
            EthnicityModel::firstOrCreate(
                ['id' => $ethnicity['id']],
                [
                    'name' => $ethnicity['name'],
                    'code' => $ethnicity['code'],
                    'active' => $ethnicity['active'],
                ]
            );
        }
    }
}
