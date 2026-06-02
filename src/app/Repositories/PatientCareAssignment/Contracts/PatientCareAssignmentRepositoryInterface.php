<?php

// app/Repositories/PatientCareAssignment/Contracts/PatientCareAssignmentRepositoryInterface.php

namespace App\Repositories\PatientCareAssignment\Contracts;

use App\Models\PatientCareAssignment;

interface PatientCareAssignmentRepositoryInterface
{
    public function create(array $data): PatientCareAssignment;
    public function endAssignment(PatientCareAssignment $assignment, ?\DateTime $endDate = null): PatientCareAssignment;
    public function update(PatientCareAssignment $assignment, array $data): PatientCareAssignment;
    public function delete(PatientCareAssignment $assignment): bool;
}
