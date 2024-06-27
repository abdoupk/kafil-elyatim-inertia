<?php

namespace App\Models;

use Database\Factories\ZoneFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $name
 *
 * @method static ZoneFactory factory($count = null, $state = [])
 * @method static Builder|Zone newModelQuery()
 * @method static Builder|Zone newQuery()
 * @method static Builder|Zone query()
 * @method static Builder|Zone whereId($value)
 * @method static Builder|Zone whereName($value)
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static Builder|Zone whereCreatedAt($value)
 * @method static Builder|Zone whereDeletedAt($value)
 * @method static Builder|Zone whereUpdatedAt($value)
 *
 * @property string $description
 * @property string $tenant_id
 *
 * @method static Builder|Zone onlyTrashed()
 * @method static Builder|Zone whereDescription($value)
 * @method static Builder|Zone whereTenantId($value)
 * @method static Builder|Zone withTrashed()
 * @method static Builder|Zone withoutTrashed()
 *
 * @property-read \App\Models\Tenant $tenant
 *
 * @mixin Eloquent
 */
class Zone extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $table = 'zones';

    protected $fillable = ['name', 'description', 'tenant_id'];

    public function searchableAs(): string
    {
        return 'zones';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tenant_id' => $this->tenant_id,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
