<?php

namespace App\Models;

use Database\Factories\BranchFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $tenant_id
 * @property int $city_id
 * @property string $president_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static BranchFactory factory($count = null, $state = [])
 * @method static Builder|Branch newModelQuery()
 * @method static Builder|Branch newQuery()
 * @method static Builder|Branch onlyTrashed()
 * @method static Builder|Branch query()
 * @method static Builder|Branch whereCityId($value)
 * @method static Builder|Branch whereCreatedAt($value)
 * @method static Builder|Branch whereId($value)
 * @method static Builder|Branch wherePresidentId($value)
 * @method static Builder|Branch whereTenantId($value)
 * @method static Builder|Branch whereUpdatedAt($value)
 * @method static Builder|Branch withTrashed()
 * @method static Builder|Branch withoutTrashed()
 *
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|Branch whereDeletedAt($value)
 *
 * @property string $name
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Family> $families
 * @property-read int|null $families_count
 * @property-read \App\Models\User $president
 * @property-read \App\Models\Tenant $tenant
 *
 * @method static Builder|Branch whereName($value)
 *
 * @mixin Eloquent
 */
class Branch extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = ['name', 'tenant_id', 'president_id'];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'tenant_id' => 'string',
        ];
    }

    public function president(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }
}
