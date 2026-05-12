<?php

namespace App\Repositories;

use App\Models\Organization;
use RonasIT\Support\Repositories\BaseRepository;

/**
 * @property Organization $model
 */
class OrganizationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Organization::class);
    }
}
