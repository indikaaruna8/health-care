<?php

// app/Repositories/Admission/AdmissionRepository.php

namespace App\Repositories\Admission;

use App\Models\Admission;
use App\Repositories\Admission\Contracts\AdmissionRepositoryInterface;

class AdmissionRepository implements AdmissionRepositoryInterface
{
    public function __construct(protected Admission $model)
    {
    }

    public function create(array $data): Admission
    {
        return $this->model->create($data);
    }

    public function update(Admission $admission, array $data): Admission
    {
        $admission->update($data);
        return $admission->fresh();
    }

    public function discharge(Admission $admission, ?\DateTime $dischargeDate = null): Admission
    {
        $admission->update([
            'status' => 'discharged',
            'discharge_date' => $dischargeDate ?? now(),
        ]);
        return $admission->fresh();
    }

    public function delete(Admission $admission): bool
    {
        return $admission->delete();
    }
}
