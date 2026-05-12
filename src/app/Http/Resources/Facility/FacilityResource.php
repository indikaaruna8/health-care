<?php

namespace App\Http\Resources\Facility;

use RonasIT\Support\Http\BaseResource;
use App\Models\Facility;

/**
 * @property Facility $resource
 */
class FacilityResource extends BaseResource
{
    //TODO implement custom serialization logic or remove method redefining
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
