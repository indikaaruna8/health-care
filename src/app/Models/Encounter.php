<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encounter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admission_id',
        'patient_id',
        'encounter_number',
        'encounter_barcode',
        'started_at',
        'ended_at',
        'type',
        'status',
        'chief_complaint',
        'recorded_by',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function labSamples()
    {
        return $this->hasMany(LabSample::class);
    }
}
