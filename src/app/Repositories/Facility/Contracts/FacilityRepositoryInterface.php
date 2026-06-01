<?php

// app/Repositories/Facility/Contracts/FacilityRepositoryInterface.php

namespace App\Repositories\Facility\Contracts;

use App\Models\Facility;

interface FacilityRepositoryInterface
{
    public function create(array $data): Facility;

    public function update(Facility $facility, array $data): Facility;

    public function delete(Facility $facility): bool;

    public function forceDelete(Facility $facility): bool;

    public function restore(Facility $facility): bool;
}
