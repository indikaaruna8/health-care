<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Model;

class Ethnicity extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'name',
        'code',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
