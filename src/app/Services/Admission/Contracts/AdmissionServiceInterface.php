<?php

// app/Services/Admission/Contracts/AdmissionServiceInterface.php

namespace App\Services\Admission\Contracts;

use App\Models\Admission;

interface AdmissionServiceInterface
{
    public function admit(array $data): Admission;
    public function update(int $id, array $data): Admission;
    public function discharge(int $id, ?\DateTime $dischargeDate = null): Admission;
    public function transfer(int $id, int $newFacilityId): Admission;
    public function delete(int $id): bool;
}
