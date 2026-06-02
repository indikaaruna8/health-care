<?php

// app/Repositories/Patient/Contracts/PatientRepositoryInterface.php

namespace App\Repositories\Patient\Contracts;

use App\Models\Patient;

interface PatientRepositoryInterface
{
    public function create(array $data): Patient;

    public function update(Patient $patient, array $data): Patient;

    public function delete(Patient $patient): bool;

    public function forceDelete(Patient $patient): bool;

    public function restore(Patient $patient): bool;
}
