<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Family> $families
 * @property-read int|null $families_count
 *
 * @method static \Database\Factories\FurnishingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Furnishing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Furnishing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Furnishing query()
 *
 * @mixin \Eloquent
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
