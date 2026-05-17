<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 organizations
        Organization::factory(20)->create();

        // Create specific organization
        Organization::factory()->create([
            'name' => 'Acme Corporation',
            'email' => 'admin@acme.com',
            'plan' => 'premium',
        ]);
    }
}
