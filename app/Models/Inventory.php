<?php

namespace App\Models;

use Database\Factories\InventoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $name
 * @property int $qty
 * @property string $unit
 * @property string|null $note
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Tenant $tenant
 *
 * @method static InventoryFactory factory($count = null, $state = [])
 * @method static Builder|Inventory newModelQuery()
 * @method static Builder|Inventory newQuery()
 * @method static Builder|Inventory onlyTrashed()
 * @method static Builder|Inventory query()
 * @method static Builder|Inventory whereCreatedAt($value)
 * @method static Builder|Inventory whereDeletedAt($value)
 * @method static Builder|Inventory whereId($value)
 * @method static Builder|Inventory whereName($value)
 * @method static Builder|Inventory whereNote($value)
 * @method static Builder|Inventory whereQty($value)
 * @method static Builder|Inventory whereTenantId($value)
 * @method static Builder|Inventory whereUnit($value)
 * @method static Builder|Inventory whereUpdatedAt($value)
 * @method static Builder|Inventory withTrashed()
 * @method static Builder|Inventory withoutTrashed()
 *
 * @mixin Eloquent
 */
class Inventory extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'qty',
        'unit',
        'tenant_id',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }

    public function searchableAs(): string
    {
        return 'inventory';
    }
}
