<?php

namespace App\Http\Resources\Organization;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationsCollectionResource extends ResourceCollection
{
    public $collects = OrganizationResource::class;
}
