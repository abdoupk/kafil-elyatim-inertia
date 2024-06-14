<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property string $name
 * @property string $report
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static Builder|Family newModelQuery()
 * @method static Builder|Family newQuery()
 * @method static Builder|Family query()
 * @method static Builder|Family whereCreatedAt($value)
 * @method static Builder|Family whereId($value)
 * @method static Builder|Family whereName($value)
 * @method static Builder|Family whereReport($value)
 * @method static Builder|Family whereTenantId($value)
 * @method static Builder|Family whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Furnishing> $furnishings
 * @property-read int|null $furnishings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orphan> $orphans
 * @property-read int|null $orphans_count
 * @property-read \App\Models\SecondSponsor|null $secondSponsor
 * @property-read \App\Models\Sponsor|null $sponsor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FamilySponsorship> $sponsorships
 * @property-read int|null $sponsorships_count
 * @property-read \App\Models\Spouse|null $spouse
 * @property-read \App\Models\Tenant $tenant
 *
 * @method static \Database\Factories\FamilyFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
class Family extends Model
{
    use HasFactory, HasUuids, Searchable;

    public $timestamps = false;

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function orphans(): HasMany
    {
        return $this->hasMany(Orphan::class);
    }

    public function secondSponsor(): HasOne
    {
        return $this->hasOne(SecondSponsor::class);
    }

    public function spouse(): HasOne
    {
        return $this->hasOne(Spouse::class);
    }

    public function sponsor(): HasOne
    {
        return $this->hasOne(Sponsor::class);
    }

    public function furnishings(): BelongsToMany
    {
        return $this->belongsToMany(Furnishing::class);
    }

    public function sponsorships(): HasMany
    {
        return $this->hasMany(FamilySponsorship::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function searchableAs(): string
    {
        return 'families_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'start_date' => $this->start_date,
            'file_number' => $this->file_number,
            'zone' => $this->zone->name,
            'report' => $this->report,
        ];
    }
}
