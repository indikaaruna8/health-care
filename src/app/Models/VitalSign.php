<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitalSign extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vital_signs';

    protected $fillable = [
        'admission_id',
        'encounter_id',
        'observation_at',
        'respiratory_rate',
        'spo2',
        'systolic_bp',
        'diastolic_bp',
        'heart_rate',
        'temperature',
        'recorded_by',
    ];

    protected $casts = [
        'observation_at' => 'datetime',
        'spo2' => 'decimal:2',
        'temperature' => 'decimal:2',
    ];

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounter::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
