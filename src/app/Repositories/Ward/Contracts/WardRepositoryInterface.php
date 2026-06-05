<?php

// app/Repositories/Ward/Contracts/WardRepositoryInterface.php

namespace App\Repositories\Ward\Contracts;

use App\Models\Ward;

interface WardRepositoryInterface
{
    public function create(array $data): Ward;
    public function update(Ward $ward, array $data): Ward;
    public function delete(Ward $ward): bool;
}
