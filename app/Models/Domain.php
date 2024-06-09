<?php

namespace App\Models;

use Database\Factories\DomainFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain as ModelsDomain;

/**
 * @property int $id
 * @property string $domain
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Tenant|null $tenant
 *
 * @method static Builder|Domain newModelQuery()
 * @method static Builder|Domain newQuery()
 * @method static Builder|Domain query()
 * @method static Builder|Domain whereCreatedAt($value)
 * @method static Builder|Domain whereDomain($value)
 * @method static Builder|Domain whereId($value)
 * @method static Builder|Domain whereTenantId($value)
 * @method static Builder|Domain whereUpdatedAt($value)
 * @method static DomainFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
class Domain extends ModelsDomain
{
    use HasFactory;

    protected $fillable = ['domain', 'tenant_id', 'id'];

    protected static function booted(): void
    {
        static::creating(static function ($domain) {
            $domain->id = Str::uuid();
        });
    }
}
