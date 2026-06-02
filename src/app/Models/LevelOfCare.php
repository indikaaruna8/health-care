<?php

// app/Models/LevelOfCare.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelOfCare extends Model
{
    use HasFactory;

    protected $table = 'level_of_care';

    protected $fillable = ['name', 'description'];

    public function careAssignments(): HasMany
    {
        return $this->hasMany(PatientCareAssignment::class);
    }
}
