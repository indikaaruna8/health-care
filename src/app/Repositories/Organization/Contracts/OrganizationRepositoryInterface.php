<?php

// app/Repositories/Organization/Contracts/OrganizationRepositoryInterface.php

namespace App\Repositories\Organization\Contracts;

use App\Models\Organization;

interface OrganizationRepositoryInterface
{
    public function create(array $data): Organization;

    public function update(Organization $organization, array $data): Organization;

    public function delete(Organization $organization): bool;

    public function forceDelete(Organization $organization): bool;

    public function restore(Organization $organization): bool;
}
