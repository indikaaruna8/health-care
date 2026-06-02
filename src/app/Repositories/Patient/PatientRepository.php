<?php

// app/Repositories/Patient/PatientRepository.php

namespace App\Repositories\Patient;

use App\Models\Patient;
use App\Repositories\Patient\Contracts\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function __construct(
        protected Patient $model
    ) {
    }

    public function create(array $data): Patient
    {
        return $this->model->create($data);
    }

    public function update(Patient $patient, array $data): Patient
    {
        $patient->update($data);
        return $patient->fresh();
    }

    public function delete(Patient $patient): bool
    {
        return $patient->delete();
    }

    public function forceDelete(Patient $patient): bool
    {
        return $patient->forceDelete();
    }

    public function restore(Patient $patient): bool
    {
        return $patient->restore();
    }
}
