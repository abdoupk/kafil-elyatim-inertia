<?php

namespace App\Models;

use Database\Factories\SponsorshipFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $tenant_id
 * @property string|null $deleted_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static SponsorshipFactory factory($count = null, $state = [])
 * @method static Builder|Sponsorship newModelQuery()
 * @method static Builder|Sponsorship newQuery()
 * @method static Builder|Sponsorship query()
 * @method static Builder|Sponsorship whereCreatedAt($value)
 * @method static Builder|Sponsorship whereDeletedAt($value)
 * @method static Builder|Sponsorship whereId($value)
 * @method static Builder|Sponsorship whereTenantId($value)
 * @method static Builder|Sponsorship whereType($value)
 * @method static Builder|Sponsorship whereUpdatedAt($value)
 *
 * @property string $name
 *
 * @method static Builder|Sponsorship whereName($value)
 *
 * @mixin Eloquent
 */
class Sponsorship extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;
}
