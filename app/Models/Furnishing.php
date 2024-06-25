<?php

namespace App\Models;

use Database\Factories\FurnishingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property-read Collection<int, Family> $families
 * @property-read int|null $families_count
 *
 * @method static FurnishingFactory factory($count = null, $state = [])
 * @method static Builder|Furnishing newModelQuery()
 * @method static Builder|Furnishing newQuery()
 * @method static Builder|Furnishing query()
 *
 * @property string $id
 * @property string $name
 *
 * @method static Builder|Furnishing whereId($value)
 * @method static Builder|Furnishing whereName($value)
 *
 * @mixin Eloquent
 */
class Furnishing extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'television',
        'refrigerator',
        'fireplace',
        'washing_machine',
        'water_heater',
        'oven',
        'wardrobe',
        'cupboard',
        'covers',
        'mattresses',
        'other_furnishings',
        'family_id',
        'tenant_id',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
