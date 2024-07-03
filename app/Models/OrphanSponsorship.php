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
 * @mixin Eloquent
 */
class OrphanSponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

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

    public $timestamps = false;

    protected $table = 'orphan_sponsorship';

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }
}
