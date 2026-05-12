<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RonasIT\Support\Traits\ModelTrait;

/**
 * Class Organization
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $type
 * @property string|null $registration_number
 * @property string|null $tax_id
 *
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $country
 *
 * @property string $plan
 * @property string $subscription_status
 * @property \Carbon\Carbon|null $trial_ends_at
 *
 * @property string|null $logo
 * @property string $timezone
 * @property string $locale
 *
 * @property int|null $owner_id
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * // Relationships
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 */
class Organization extends Model
{
    use ModelTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'registration_number',
        'tax_id',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'plan',
        'subscription_status',
        'trial_ends_at',
        'logo',
        'timezone',
        'locale',
        'owner_id',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    protected $hidden = ['pivot'];

    /**
     * One organization has many facilities
     */
    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }
}
