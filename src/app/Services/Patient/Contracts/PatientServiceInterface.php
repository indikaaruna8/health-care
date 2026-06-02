<?php

// app/Services/Patient/Contracts/PatientServiceInterface.php

namespace App\Services\Patient\Contracts;

use App\Models\Patient;

interface PatientServiceInterface
{
    public function create(array $data): Patient;

    public function update(Patient $patient, array $data): Patient;

    public function delete(Patient $patient): bool;

    public function forceDelete(int $id): bool;

    public function restore(int $id): Patient;
}
