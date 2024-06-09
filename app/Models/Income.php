<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 *
 * @method static Builder|Income newModelQuery()
 * @method static Builder|Income newQuery()
 * @method static Builder|Income query()
 * @method static Builder|Income whereId($value)
 * @method static Builder|Income whereName($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sponsor> $sponsors
 * @property-read int|null $sponsors_count
 *
 * @method static \Database\Factories\IncomeFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
class Income extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class)->using(IncomeSponsor::class);
    }
}
