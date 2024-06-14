<?php

namespace App\Models;

use Database\Factories\FurnishingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    use HasFactory, HasUuids;

    public $timestamps = false;

    public function families(): BelongsToMany
    {
        return $this->belongsToMany(Family::class);
    }
}
