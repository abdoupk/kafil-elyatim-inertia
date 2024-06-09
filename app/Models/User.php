<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Settings|null $settings
 * @property-read Tenant $tenant
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereTenantId($value)
 * @method static Builder|User whereUpdatedAt($value)
 *
 * @property-read Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 *
 * @method static Builder|User permission($permissions, $without = false)
 * @method static Builder|User role($roles, $guard = null, $without = false)
 * @method static Builder|User withoutPermission($permissions)
 * @method static Builder|User withoutRole($roles, $guard = null)
 *
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use BelongsToTenant, HasApiTokens, HasFactory, HasRoles, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(static function (User $user) {
            $user->settings()->create([
                'theme' => 'enigma',
                'color_scheme' => 'default',
                'layout' => 'side_menu',
                'appearance' => 'light',
            ]);
        });
    }

    public function settings(): HasOne
    {
        return $this->hasOne(Settings::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
