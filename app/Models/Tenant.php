<?php

namespace App\Models;

use Database\Factories\TenantFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\TenantCollection;

/**
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property array|null $data
 * @property-read Collection<int, \Stancl\Tenancy\Database\Models\Domain> $domains
 * @property-read int|null $domains_count
 *
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static Builder|Tenant newModelQuery()
 * @method static Builder|Tenant newQuery()
 * @method static Builder|Tenant query()
 * @method static Builder|Tenant whereCreatedAt($value)
 * @method static Builder|Tenant whereData($value)
 * @method static Builder|Tenant whereId($value)
 * @method static Builder|Tenant whereUpdatedAt($value)
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantFactory factory($count = null, $state = [])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 *
 * @property-read Collection<int, Family> $families
 * @property-read int|null $families_count
 * @property-read Collection<int, User> $members
 * @property-read int|null $members_count
 *
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 * @method static TenantCollection<int, static> all($columns = ['*'])
 * @method static TenantCollection<int, static> get($columns = ['*'])
 *
 * @mixin Eloquent
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory;

    public static function booted(): void
    {
        static::creating(function ($tenant) {
            $tenant->password = bcrypt($tenant->password);
        });
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
