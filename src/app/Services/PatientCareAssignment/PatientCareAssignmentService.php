<?php

// app/Services/PatientCareAssignment/PatientCareAssignmentService.php

namespace App\Services\PatientCareAssignment;

use App\Models\PatientCareAssignment;
use App\Repositories\Bed\Contracts\BedRepositoryInterface;
use App\Repositories\PatientCareAssignment\Contracts\PatientCareAssignmentRepositoryInterface;
use App\Services\PatientCareAssignment\Contracts\PatientCareAssignmentServiceInterface;

class PatientCareAssignmentService implements PatientCareAssignmentServiceInterface
{
    public function __construct(
        protected PatientCareAssignmentRepositoryInterface $repository,
        protected BedRepositoryInterface $bedRepository
    ) {
    }

    public function assign(array $data): PatientCareAssignment
    {
        $activeAssignment = PatientCareAssignment::where('admission_id', $data['admission_id'])
            ->whereNull('end_datetime')
            ->first();

        if ($activeAssignment) {
            $this->repository->endAssignment($activeAssignment);
        }

        $assignment = $this->repository->create($data);

        $this->bedRepository->updateStatus(
            \App\Models\Bed::findOrFail($data['bed_id']),
            'occupied'
        );

        return $assignment;
    }

    public function endAssignment(int $id, ?\DateTime $endDate = null): PatientCareAssignment
    {
        $assignment = PatientCareAssignment::findOrFail($id);

        if (!$assignment->isActive()) {
            throw new \RuntimeException('Assignment is already ended.');
        }

        $ended = $this->repository->endAssignment($assignment, $endDate);

        $this->bedRepository->updateStatus($assignment->bed, 'available');

        return $ended;
    }

    public function transfer(int $id, array $newData): PatientCareAssignment
    {
        $current = PatientCareAssignment::findOrFail($id);

        if ($current->isActive()) {
            $this->repository->endAssignment($current);
            $this->bedRepository->updateStatus($current->bed, 'available');
        }

        return $this->assign(array_merge([
            'admission_id' => $current->admission_id,
        ], $newData));
    }

    public function update(int $id, array $data): PatientCareAssignment
    {
        $assignment = PatientCareAssignment::findOrFail($id);
        return $this->repository->update($assignment, $data);
    }

    public function delete(int $id): bool
    {
        $assignment = PatientCareAssignment::findOrFail($id);
        return $this->repository->delete($assignment);
    }
}
