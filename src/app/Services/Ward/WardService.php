<?php

// app/Services/Ward/WardService.php

namespace App\Services\Ward;

use App\Models\Ward;
use App\Repositories\Ward\Contracts\WardRepositoryInterface;
use App\Services\Ward\Contracts\WardServiceInterface;

class WardService implements WardServiceInterface
{
    public function __construct(protected WardRepositoryInterface $repository)
    {
    }

    public function create(array $data): Ward
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): Ward
    {
        $ward = Ward::findOrFail($id);
        return $this->repository->update($ward, $data);
    }

    public function delete(int $id): bool
    {
        $ward = Ward::findOrFail($id);
        return $this->repository->delete($ward);
    }
}
