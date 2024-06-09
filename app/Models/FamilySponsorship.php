<?php

namespace App\Models;

use Database\Factories\FamilySponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin Eloquent
 */
class FamilySponsorship extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'family_sponsorship';
}
