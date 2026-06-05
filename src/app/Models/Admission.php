<?php

// app/Models/Admission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'facility_id',
        'patient_id',
        'admission_date',
        'discharge_date',
        'status',
    ];

    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function careAssignments(): HasMany
    {
        return $this->hasMany(PatientCareAssignment::class);
    }

    public function currentCareAssignment(): ?PatientCareAssignment
    {
        return $this->careAssignments()
            ->whereNull('end_datetime')
            ->latest('start_datetime')
            ->first();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'admitted');
    }

    public function scopeForFacility($query, int $facilityId)
    {
        return $query->where('facility_id', $facilityId);
    }

    public function scopeForPatient($query, int $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['admitted', 'transferred']);
    }
}
