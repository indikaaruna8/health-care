<?php

namespace App\Http\Resources\Facility;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FacilitiesCollectionResource extends ResourceCollection
{
    public $collects = FacilityResource::class;
}
