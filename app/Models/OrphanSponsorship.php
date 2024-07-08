<?php

namespace App\Models;

use Database\Factories\OrphanSponsorshipFactory;
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
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

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

    public function searchableAs(): string
    {
        return 'orphan_sponsorships';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('orphan', 'orphan.sponsor', 'orphan.family', 'orphan.family.zone', 'orphan.lastAcademicYearAchievement');
    }

    public function toSearchableArray(): array
    {
        return [
            'medical_sponsorship' => $this->medical_sponsorship,
            'university_scholarship' => $this->university_scholarship,
            'association_trips' => $this->association_trips,
            'summer_camp' => $this->summer_camp,
            'eid_suit' => $this->eid_suit,
            'private_lessons' => $this->private_lessons,
            'school_bag' => $this->school_bag,
            'family' => [
                'address' => $this->orphan->family->address,
                'zone' => $this->orphan->family->zone->name,
            ],
            'orphan' => [
                'id' => $this->orphan->id,
                'name' => $this->orphan->getName(),
                'academic_level' => $this->orphan?->lastAcademicYearAchievement?->academic_level,
                'academic_phase' => $this->orphan?->lastAcademicYearAchievement?->academic_phase,
                'year_average' => (float) $this->orphan?->lastAcademicYearAchievement?->average,
                'shirt_size' => $this->orphan->shirt_size,
                'pants_size' => $this->orphan->pants_size,
                'shoes_size' => $this->orphan->shoes_size,
            ],
            'sponsor' => [
                'name' => $this->orphan->sponsor->getName(),
                'phone_number' => $this->orphan->sponsor->phone_number,
            ],
            'tenant_id' => $this->orphan->tenant_id,
        ];
    }

    public function searchable() {}
}
