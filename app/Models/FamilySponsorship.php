<?php

namespace App\Models;

use Database\Factories\FamilySponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    use BelongsToTenant, HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'family_sponsorship';

    protected $fillable = [
        'family_id',
        'tenant_id',
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
}
