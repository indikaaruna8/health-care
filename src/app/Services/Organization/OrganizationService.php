<?php

// app/Services/Organization/OrganizationService.php

namespace App\Services\Organization;

use App\Models\Organization;
use App\Repositories\Organization\Contracts\OrganizationRepositoryInterface;
use App\Services\Organization\Contracts\OrganizationServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizationService implements OrganizationServiceInterface
{
    public function __construct(
        protected OrganizationRepositoryInterface $repository
    ) {
    }

    public function create(array $data): Organization
    {
        return $this->repository->create($data);
    }

    public function update(Organization $organization, array $data): Organization
    {
        return $this->repository->update($organization, $data);
    }

    public function delete(Organization $organization): bool
    {
        return $this->repository->delete($organization);
    }

    public function forceDelete(int $id): bool
    {
        $organization = Organization::withTrashed()->findOrFail($id);
        return $this->repository->forceDelete($organization);
    }

    public function restore(int $id): Organization
    {
        $organization = Organization::withTrashed()->findOrFail($id);

        if (!$organization->trashed()) {
            throw new \RuntimeException('Organization is not deleted.');
        }

        $this->repository->restore($organization);

        return $organization->fresh();
    }
}
