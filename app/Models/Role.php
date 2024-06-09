<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property string $uuid
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role permission($permissions, $without = false)
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static Builder|Role whereUuid($value)
 * @method static Builder|Role withoutPermission($permissions)
 *
 * @mixin Eloquent
 */
class Role extends SpatieRole
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';
}
