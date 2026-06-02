<?php

// app/Models/PatientCareAssignment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientCareAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_id',
        'level_of_care_id',
        'ward_id',
        'bed_id',
        'start_datetime',
        'end_datetime',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function levelOfCare(): BelongsTo
    {
        return $this->belongsTo(LevelOfCare::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('end_datetime');
    }

    public function scopeForAdmission($query, int $admissionId)
    {
        return $query->where('admission_id', $admissionId);
    }

    public function isActive(): bool
    {
        return is_null($this->end_datetime);
    }
}
