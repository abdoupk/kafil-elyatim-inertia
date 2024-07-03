<?php

namespace App\Models;

use Database\Factories\SponsorSponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property string $sponsor_id
 * @property string $sponsorship_id
 * @property string $type
 * @property string $value
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static SponsorSponsorshipFactory factory($count = null, $state = [])
 * @method static Builder|SponsorSponsorship newModelQuery()
 * @method static Builder|SponsorSponsorship newQuery()
 * @method static Builder|SponsorSponsorship query()
 * @method static Builder|SponsorSponsorship whereCreatedAt($value)
 * @method static Builder|SponsorSponsorship whereId($value)
 * @method static Builder|SponsorSponsorship whereSponsorId($value)
 * @method static Builder|SponsorSponsorship whereSponsorshipId($value)
 * @method static Builder|SponsorSponsorship whereTenantId($value)
 * @method static Builder|SponsorSponsorship whereType($value)
 * @method static Builder|SponsorSponsorship whereUpdatedAt($value)
 * @method static Builder|SponsorSponsorship whereValue($value)
 *
 * @mixin Eloquent
 */
class SponsorSponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'sponsor_id',
        'medical_sponsorship',
        'literacy_lessons',
        'direct_sponsorship',
        'project_support',
        'tenant_id',
    ];

    protected $table = 'sponsor_sponsorship';

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }
}
