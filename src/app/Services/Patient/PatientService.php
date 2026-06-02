<?php

// app/Services/Patient/PatientService.php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Repositories\Patient\Contracts\PatientRepositoryInterface;
use App\Services\Patient\Contracts\PatientServiceInterface;

class PatientService implements PatientServiceInterface
{
    public function __construct(
        protected PatientRepositoryInterface $repository
    ) {
    }

    public function create(array $data): Patient
    {
        return $this->repository->create($data);
    }

    public function update(Patient $patient, array $data): Patient
    {
        return $this->repository->update($patient, $data);
    }

    public function delete(Patient $patient): bool
    {
        return $this->repository->delete($patient);
    }

    public function forceDelete(int $id): bool
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        return $this->repository->forceDelete($patient);
    }

    public function restore(int $id): Patient
    {
        $patient = Patient::withTrashed()->findOrFail($id);

        if (!$patient->trashed()) {
            throw new \RuntimeException('Patient is not deleted.');
        }

        $this->repository->restore($patient);

        return $patient->fresh();
    }
}
