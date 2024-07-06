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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $deleted_at
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
 * @property-read Spouse|null $deceased
 * @property-read Housing|null $housing
 * @property-read Preview|null $preview
 * @property-read Collection<int, Baby> $babies
 * @property-read int|null $babies_count
 * @property-read Collection<int, OrphanSponsorship> $orphansSponsorships
 * @property-read int|null $orphans_sponsorships_count
 * @property-read Collection<int, SponsorSponsorship> $sponsorSponsorships
 * @property-read int|null $sponsor_sponsorships_count
 * @property-read Branch|null $branch
 *
 * @mixin Eloquent
 */
class Family extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
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

    public function preview(): HasOne
    {
        return $this->hasOne(Preview::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
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

    public function sponsorships(): HasOne
    {
        return $this->hasOne(FamilySponsorship::class);
    }

    public function orphansSponsorships(): HasManyThrough
    {
        return $this->hasManyThrough(OrphanSponsorship::class, Orphan::class);
    }

    public function sponsorSponsorships(): HasOneThrough
    {
        return $this->hasOneThrough(SponsorSponsorship::class, Sponsor::class);
    }

    public function deceased(): HasOne
    {
        return $this->hasOne(Spouse::class);
    }

    public function housing(): HasOne
    {
        return $this->hasOne(Housing::class);
    }

    public function furnishings(): HasOne
    {
        return $this->hasOne(Furnishing::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function babies(): HasMany
    {
        return $this->hasMany(Baby::class);
    }

    public function searchableAs(): string
    {
        return 'families';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(['zone', 'secondSponsor', 'spouse']);
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
            'spouse' => [
                'name' => $this->spouse?->getName(),
                'function' => $this->spouse?->function,
            ],
            'second_sponsor' => [
                'name' => $this->secondSponsor?->getName(),
                'degree_of_kinship' => $this->secondSponsor?->degree_of_kinship,
                'address' => $this->secondSponsor?->address,
            ],
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'preview_date' => 'date',
        ];
    }

    public function totalIncomes(): float
    {
        return (float) number_format($this->sponsor->incomes->total_income, 2);
    }
}
