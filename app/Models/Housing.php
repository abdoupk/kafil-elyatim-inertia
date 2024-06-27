<?php

namespace App\Models;

use Database\Factories\HousingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property string $name
 *
 * @method static HousingFactory factory($count = null, $state = [])
 * @method static Builder|Housing newModelQuery()
 * @method static Builder|Housing newQuery()
 * @method static Builder|Housing query()
 * @method static Builder|Housing whereId($value)
 * @method static Builder|Housing whereName($value)
 *
 * @property string $value
 * @property string|null $housing_receipt_number
 * @property int|null $number_of_rooms
 * @property string|null $other_properties
 * @property string $family_id
 * @property string $tenant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family $family
 * @property-read \App\Models\Tenant $tenant
 *
 * @method static Builder|Housing whereCreatedAt($value)
 * @method static Builder|Housing whereFamilyId($value)
 * @method static Builder|Housing whereHousingReceiptNumber($value)
 * @method static Builder|Housing whereNumberOfRooms($value)
 * @method static Builder|Housing whereOtherProperties($value)
 * @method static Builder|Housing whereTenantId($value)
 * @method static Builder|Housing whereUpdatedAt($value)
 * @method static Builder|Housing whereValue($value)
 *
 * @mixin Eloquent
 */
class Housing extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'value',
        'family_id',
        'tenant_id',
        'housing_receipt_number',
        'number_of_rooms',
        'other_properties',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
