<?php

// app/Models/Patient.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nhi_number',
        'first_name',
        'last_name',
        'preferred_name',
        'date_of_birth',
        'gender',
        'ethnicity',
        'address',
        'mobile_phone',
        'email',
        'preferred_language',
        'interpreter_required',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'interpreter_required' => 'boolean',
    ];

    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class);
    }

    public function currentAdmission(): ?Admission
    {
        return $this->admissions()
            ->whereIn('status', ['admitted', 'transferred'])
            ->latest('admission_date')
            ->first();
    }

    public function scopeSearchName($query, string $name)
    {
        $search = '%' . $name . '%';
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', $search)
              ->orWhere('last_name', 'like', $search)
              ->orWhere('preferred_name', 'like', $search);
        });
    }

    public function scopeByNhi($query, string $nhi)
    {
        return $query->where('nhi_number', $nhi);
    }
}
