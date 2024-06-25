<?php

namespace App\Models;

use Database\Factories\FamilyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

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
 * @property-read Collection<int, Furnishing> $furnishings
 * @property-read int|null $furnishings_count
 * @property-read Collection<int, Orphan> $orphans
 * @property-read int|null $orphans_count
 * @property-read SecondSponsor|null $secondSponsor
 * @property-read Sponsor|null $sponsor
 * @property-read Collection<int, FamilySponsorship> $sponsorships
 * @property-read int|null $sponsorships_count
 * @property-read Spouse|null $spouse
 * @property-read Tenant $tenant
 *
 * @method static FamilyFactory factory($count = null, $state = [])
 *
 * @property string $zone_id
 * @property string $address
 * @property int $file_number
 * @property string $start_date
 * @property-read Zone|null $zone
 *
 * @method static Builder|Family whereAddress($value)
 * @method static Builder|Family whereFileNumber($value)
 * @method static Builder|Family whereStartDate($value)
 * @method static Builder|Family whereZoneId($value)
 *
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static Builder|Family onlyTrashed()
 * @method static Builder|Family whereDeletedAt($value)
 * @method static Builder|Family withTrashed()
 * @method static Builder|Family withoutTrashed()
 *
 * @property string|null $branch_id
 *
 * @method static Builder|Family whereBranchId($value)
 *
 * @mixin Eloquent
 */
class Family extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable,SoftDeletes;

    protected $fillable = [
        'name',
        'report',
        'tenant_id',
        'zone_id',
        'address',
        'file_number',
        'start_date',
        'branch_id',
    ];

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

    public function deceased(): HasOne
    {
        return $this->hasOne(Spouse::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function searchableAs(): string
    {
        return 'families';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('zone');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
            'start_date' => $this->start_date,
            'file_number' => $this->file_number,
            'address' => [
                'address' => $this->address,
                'zone' => [
                    'name' => $this->zone?->name,
                    'id' => $this->zone?->id,
                ],
            ],
            'report' => $this->report,
        ];
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
        ];
    }
}
