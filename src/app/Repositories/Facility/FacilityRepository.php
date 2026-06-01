<?php

// app/Repositories/Facility/FacilityRepository.php

namespace App\Repositories\Facility;

use App\Models\Facility;
use App\Repositories\Facility\Contracts\FacilityRepositoryInterface;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function __construct(
        protected Facility $model
    ) {
    }

    public function create(array $data): Facility
    {
        return $this->model->create($data);
    }

    public function update(Facility $facility, array $data): Facility
    {
        $facility->update($data);
        return $facility->fresh();
    }

    public function delete(Facility $facility): bool
    {
        return $facility->delete();
    }

    public function forceDelete(Facility $facility): bool
    {
        return $facility->forceDelete();
    }

    public function restore(Facility $facility): bool
    {
        return $facility->restore();
    }
}
