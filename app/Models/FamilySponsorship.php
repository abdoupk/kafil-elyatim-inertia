<?php

namespace App\Models;

use Database\Factories\FamilySponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property string $family_id
 * @property string $sponsorship_id
 * @property string $type
 * @property string $value
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static FamilySponsorshipFactory factory($count = null, $state = [])
 * @method static Builder|FamilySponsorship newModelQuery()
 * @method static Builder|FamilySponsorship newQuery()
 * @method static Builder|FamilySponsorship query()
 * @method static Builder|FamilySponsorship whereCreatedAt($value)
 * @method static Builder|FamilySponsorship whereFamilyId($value)
 * @method static Builder|FamilySponsorship whereId($value)
 * @method static Builder|FamilySponsorship whereSponsorshipId($value)
 * @method static Builder|FamilySponsorship whereTenantId($value)
 * @method static Builder|FamilySponsorship whereType($value)
 * @method static Builder|FamilySponsorship whereUpdatedAt($value)
 * @method static Builder|FamilySponsorship whereValue($value)
 *
 * @property string|null $monthly_allowance
 * @property string|null $ramadan_basket
 * @property string|null $zakat
 * @property string|null $housing_assistance
 * @property string|null $eid_al_adha
 * @property-read Family $family
 * @property-read Tenant $tenant
 *
 * @method static Builder|FamilySponsorship whereEidAlAdha($value)
 * @method static Builder|FamilySponsorship whereHousingAssistance($value)
 * @method static Builder|FamilySponsorship whereMonthlyAllowance($value)
 * @method static Builder|FamilySponsorship whereRamadanBasket($value)
 * @method static Builder|FamilySponsorship whereZakat($value)
 *
 * @mixin Eloquent
 */
class FamilySponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

    public $timestamps = false;

    protected $table = 'family_sponsorship';

    protected $fillable = [
        //        'family_id',
        'monthly_allowance',
        'ramadan_basket',
        'zakat',
        'housing_assistance',
        'eid_al_adha',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function searchableAs(): string
    {
        return 'family_sponsorships';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('family.sponsor.incomes', 'family.zone', 'family.orphans', 'family.secondSponsor', 'family.branch');
    }

    public function toSearchableArray(): array
    {
        return [
            'monthly_allowance' => $this->monthly_allowance,
            'ramadan_basket' => $this->ramadan_basket,
            'zakat' => $this->zakat,
            'housing_assistance' => $this->housing_assistance,
            'eid_al_adha' => $this->eid_al_adha,
            'family' => [
                'address' => $this->family->address,
                'zone' => [
                    'id' => $this->family->zone->id,
                    'name' => $this->family->zone->name,
                ],
                'branch' => [
                    'id' => $this->family->branch->id,
                    'name' => $this->family->branch->name,
                ],
                'orphans_count' => $this->family->orphans->count(),
                'income_rate' => (float) $this->family->income_rate,
                'total_income' => $this->family->totalIncomes(),
            ],
            'sponsor' => [
                'name' => $this->family->sponsor->getName(),
                'phone_number' => $this->family->sponsor->phone_number,
            ],
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
        ];
    }
}
