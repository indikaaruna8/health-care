<?php

namespace App\Http\Resources\Organization;

use RonasIT\Support\Http\BaseResource;
use App\Models\Organization;

/**
 * @property Organization $resource
 */
class OrganizationResource extends BaseResource
{
    //TODO implement custom serialization logic or remove method redefining
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
