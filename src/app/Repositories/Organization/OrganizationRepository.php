<?php

// app/Repositories/Organization/OrganizationRepository.php

namespace App\Repositories\Organization;

use App\Models\Organization;
use App\Repositories\Organization\Contracts\OrganizationRepositoryInterface;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function __construct(
        protected Organization $model
    ) {
    }

    public function create(array $data): Organization
    {
        return $this->model->create($data);
    }

    public function update(Organization $organization, array $data): Organization
    {
        $organization->update($data);
        return $organization->fresh();
    }

    public function delete(Organization $organization): bool
    {
        return $organization->delete();
    }

    public function forceDelete(Organization $organization): bool
    {
        return $organization->forceDelete();
    }

    public function restore(Organization $organization): bool
    {
        return $organization->restore();
    }
}
