<?php

// app/Services/Admission/AdmissionService.php

namespace App\Services\Admission;

use App\Models\Admission;
use App\Repositories\Admission\Contracts\AdmissionRepositoryInterface;
use App\Services\Admission\Contracts\AdmissionServiceInterface;

class AdmissionService implements AdmissionServiceInterface
{
    public function __construct(
        protected AdmissionRepositoryInterface $repository,
        protected \App\Services\Admission\Contracts\AdmissionSearchServiceInterface $searchService
    ) {
    }

    public function admit(array $data): Admission
    {
        if ($this->searchService->hasActiveAdmission($data['patient_id'])) {
            throw new \RuntimeException('Patient already has an active admission.');
        }

        return $this->repository->create(array_merge($data, [
            'status' => 'admitted',
            'admission_date' => $data['admission_date'] ?? now(),
        ]));
    }

    public function update(int $id, array $data): Admission
    {
        $admission = Admission::findOrFail($id);
        return $this->repository->update($admission, $data);
    }

    public function discharge(int $id, ?\DateTime $dischargeDate = null): Admission
    {
        $admission = Admission::findOrFail($id);

        if (!$admission->isActive()) {
            throw new \RuntimeException('Admission is not active.');
        }

        return $this->repository->discharge($admission, $dischargeDate);
    }

    public function transfer(int $id, int $newFacilityId): Admission
    {
        $admission = Admission::findOrFail($id);

        if (!$admission->isActive()) {
            throw new \RuntimeException('Cannot transfer a non-active admission.');
        }

        $this->repository->discharge($admission, now());

        return $this->repository->create([
            'patient_id' => $admission->patient_id,
            'facility_id' => $newFacilityId,
            'status' => 'admitted',
            'admission_date' => now(),
        ]);
    }

    public function delete(int $id): bool
    {
        $admission = Admission::findOrFail($id);
        return $this->repository->delete($admission);
    }
}
