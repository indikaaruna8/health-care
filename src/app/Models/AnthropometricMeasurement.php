<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnthropometricMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_id',
        'weight_kg',
        'height_cm',
        'bmi',
        'measured_at',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'height_cm' => 'decimal:2',
        'bmi' => 'decimal:2',
        'measured_at' => 'datetime',
    ];

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    protected static function booted(): void
    {
        static::saving(function ($measurement) {
            if ($measurement->weight_kg && $measurement->height_cm) {
                $heightM = $measurement->height_cm / 100;
                $measurement->bmi = round($measurement->weight_kg / ($heightM * $heightM), 2);
            }
        });
    }
}
