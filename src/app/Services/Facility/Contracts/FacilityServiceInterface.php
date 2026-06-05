<?php

// app/Services/Facility/Contracts/FacilityServiceInterface.php

namespace App\Services\Facility\Contracts;

use App\Models\Facility;

interface FacilityServiceInterface
{
    public function create(array $data): Facility;

    public function update(Facility $facility, array $data): Facility;

    public function delete(Facility $facility): bool;

    public function forceDelete(int $id): bool;

    public function restore(int $id): Facility;
}
