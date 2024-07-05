<?php

namespace App\Models;

use Database\Factories\OrphanSponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property string $orphan_id
 * @property string $sponsorship_id
 * @property string $type
 * @property string $value
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static OrphanSponsorshipFactory factory($count = null, $state = [])
 * @method static Builder|OrphanSponsorship newModelQuery()
 * @method static Builder|OrphanSponsorship newQuery()
 * @method static Builder|OrphanSponsorship query()
 * @method static Builder|OrphanSponsorship whereCreatedAt($value)
 * @method static Builder|OrphanSponsorship whereId($value)
 * @method static Builder|OrphanSponsorship whereOrphanId($value)
 * @method static Builder|OrphanSponsorship whereSponsorshipId($value)
 * @method static Builder|OrphanSponsorship whereTenantId($value)
 * @method static Builder|OrphanSponsorship whereType($value)
 * @method static Builder|OrphanSponsorship whereUpdatedAt($value)
 * @method static Builder|OrphanSponsorship whereValue($value)
 *
 * @property string|null $medical_sponsorship
 * @property string|null $university_scholarship
 * @property string|null $association_trips
 * @property string|null $summer_camp
 * @property string|null $eid_suit
 * @property string|null $private_lessons
 * @property string|null $school_bag
 * @property-read Orphan $orphan
 * @property-read Tenant $tenant
 *
 * @method static Builder|OrphanSponsorship whereAssociationTrips($value)
 * @method static Builder|OrphanSponsorship whereEidSuit($value)
 * @method static Builder|OrphanSponsorship whereMedicalSponsorship($value)
 * @method static Builder|OrphanSponsorship wherePrivateLessons($value)
 * @method static Builder|OrphanSponsorship whereSchoolBag($value)
 * @method static Builder|OrphanSponsorship whereSummerCamp($value)
 * @method static Builder|OrphanSponsorship whereUniversityScholarship($value)
 *
 * @mixin Eloquent
 */
class OrphanSponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'orphan_id',
        'medical_sponsorship',
        'university_scholarship',
        'association_trips',
        'summer_camp',
        'eid_suit',
        'private_lessons',
        'school_bag',
        'tenant_id',
    ];

    protected $table = 'orphan_sponsorship';

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }
}
