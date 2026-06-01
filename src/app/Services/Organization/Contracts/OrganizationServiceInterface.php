<?php

// app/Services/Organization/Contracts/OrganizationServiceInterface.php

namespace App\Services\Organization\Contracts;

use App\Models\Organization;

interface OrganizationServiceInterface
{
    public function create(array $data): Organization;

    public function update(Organization $organization, array $data): Organization;

    public function delete(Organization $organization): bool;

    public function forceDelete(int $id): bool;

    public function restore(int $id): Organization;
}
