<?php

namespace App\Repositories;

use App\Models\Facility;
use RonasIT\Support\Repositories\BaseRepository;

/**
 * @property Facility $model
 */
class FacilityRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Facility::class);
    }
}
