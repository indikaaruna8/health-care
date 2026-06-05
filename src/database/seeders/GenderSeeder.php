<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Models\Gender as GenderModel;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $genders = Gender::all();

        foreach ($genders as $gender) {
            GenderModel::firstOrCreate(
                ['id' => $gender['id']],
                [
                    'name' => $gender['name'],
                    'code' => $gender['code'],
                    'active' => $gender['active'],
                ]
            );
        }
    }
}
