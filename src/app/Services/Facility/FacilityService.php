<?php

// app/Services/Facility/FacilityService.php

namespace App\Services\Facility;

use App\Models\Facility;
use App\Repositories\Facility\Contracts\FacilityRepositoryInterface;
use App\Services\Facility\Contracts\FacilityServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FacilityService implements FacilityServiceInterface
{
    public function __construct(
        protected FacilityRepositoryInterface $repository
    ) {
    }

    public function create(array $data): Facility
    {
        return $this->repository->create($data);
    }

    public function update(Facility $facility, array $data): Facility
    {
        return $this->repository->update($facility, $data);
    }

    public function delete(Facility $facility): bool
    {
        return $this->repository->delete($facility);
    }

    public function forceDelete(int $id): bool
    {
        $facility = Facility::withTrashed()->findOrFail($id);
        return $this->repository->forceDelete($facility);
    }

    public function restore(int $id): Facility
    {
        $facility = Facility::withTrashed()->findOrFail($id);

        if (!$facility->trashed()) {
            throw new \RuntimeException('Facility is not deleted.');
        }

        $this->repository->restore($facility);

        return $facility->fresh();
    }
}
