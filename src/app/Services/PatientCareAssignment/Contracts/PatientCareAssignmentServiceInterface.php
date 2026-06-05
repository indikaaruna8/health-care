<?php

// app/Services/PatientCareAssignment/Contracts/PatientCareAssignmentServiceInterface.php

namespace App\Services\PatientCareAssignment\Contracts;

use App\Models\PatientCareAssignment;

interface PatientCareAssignmentServiceInterface
{
    public function assign(array $data): PatientCareAssignment;
    public function endAssignment(int $id, ?\DateTime $endDate = null): PatientCareAssignment;
    public function transfer(int $id, array $newAssignmentData): PatientCareAssignment;
    public function update(int $id, array $data): PatientCareAssignment;
    public function delete(int $id): bool;
}
