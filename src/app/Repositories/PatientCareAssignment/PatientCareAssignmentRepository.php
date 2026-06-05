<?php

// app/Repositories/PatientCareAssignment/PatientCareAssignmentRepository.php

namespace App\Repositories\PatientCareAssignment;

use App\Models\PatientCareAssignment;
use App\Repositories\PatientCareAssignment\Contracts\PatientCareAssignmentRepositoryInterface;

class PatientCareAssignmentRepository implements PatientCareAssignmentRepositoryInterface
{
    public function __construct(protected PatientCareAssignment $model)
    {
    }

    public function create(array $data): PatientCareAssignment
    {
        return $this->model->create(array_merge($data, [
            'start_datetime' => $data['start_datetime'] ?? now(),
        ]));
    }

    public function endAssignment(PatientCareAssignment $assignment, ?\DateTime $endDate = null): PatientCareAssignment
    {
        $assignment->update(['end_datetime' => $endDate ?? now()]);
        return $assignment->fresh();
    }

    public function update(PatientCareAssignment $assignment, array $data): PatientCareAssignment
    {
        $assignment->update($data);
        return $assignment->fresh();
    }

    public function delete(PatientCareAssignment $assignment): bool
    {
        return $assignment->delete();
    }
}
