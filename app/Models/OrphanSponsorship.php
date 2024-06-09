<?php

namespace App\Models;

use Database\Factories\OrphanSponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'orphan_sponsorship';
}
