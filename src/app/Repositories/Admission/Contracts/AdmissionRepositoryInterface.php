<?php

// app/Repositories/Admission/Contracts/AdmissionRepositoryInterface.php

namespace App\Repositories\Admission\Contracts;

use App\Models\Admission;

interface AdmissionRepositoryInterface
{
    public function create(array $data): Admission;
    public function update(Admission $admission, array $data): Admission;
    public function discharge(Admission $admission, ?\DateTime $dischargeDate = null): Admission;
    public function delete(Admission $admission): bool;
}
