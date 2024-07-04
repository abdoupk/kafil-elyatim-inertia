<?php

namespace App\Models;

use Database\Factories\BabyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property int|null $baby_milk_quantity
 * @property string|null $baby_milk_type
 * @property int|null $diapers_quantity
 * @property string|null $diapers_type
 * @property string $orphan_id
 * @property string $family_id
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Tenant $tenant
 *
 * @method static BabyFactory factory($count = null, $state = [])
 * @method static Builder|Baby newModelQuery()
 * @method static Builder|Baby newQuery()
 * @method static Builder|Baby onlyTrashed()
 * @method static Builder|Baby query()
 * @method static Builder|Baby whereBabyMilkQuantity($value)
 * @method static Builder|Baby whereBabyMilkType($value)
 * @method static Builder|Baby whereCreatedAt($value)
 * @method static Builder|Baby whereDeletedAt($value)
 * @method static Builder|Baby whereDiapersQuantity($value)
 * @method static Builder|Baby whereDiapersType($value)
 * @method static Builder|Baby whereFamilyId($value)
 * @method static Builder|Baby whereId($value)
 * @method static Builder|Baby whereOrphanId($value)
 * @method static Builder|Baby whereTenantId($value)
 * @method static Builder|Baby whereUpdatedAt($value)
 * @method static Builder|Baby withTrashed()
 * @method static Builder|Baby withoutTrashed()
 *
 * @mixin Eloquent
 */
class Baby extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'baby_milk_quantity',
        'baby_milk_type',
        'diapers_quantity',
        'diapers_type',
        'tenant_id',
        'orphan_id',
        'family_id',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
            'orphan_id' => 'string',
        ];
    }
}
