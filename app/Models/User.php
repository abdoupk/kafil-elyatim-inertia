<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
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
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 *
 * @method static Builder|User permission($permissions, $without = false)
 * @method static Builder|User role($roles, $guard = null, $without = false)
 * @method static Builder|User withoutPermission($permissions)
 * @method static Builder|User withoutRole($roles, $guard = null)
 *
 * @property string|null $zone_id
 *
 * @method static Builder|User whereZoneId($value)
 *
 * @property string|null $gender
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|User onlyTrashed()
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 *
 * @property-read Zone|null $zone
 * @property string|null $qualification
 * @property-read Collection<int, Preview> $previews
 * @property-read int|null $previews_count
 *
 * @method static Builder|User whereQualification($value)
 *
 * @property string|null $address
 * @property string|null $branch_id
 * @property-read Branch|null $branch
 *
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereBranchId($value)
 *
 * @property-read MemberPreview $pivot
 *
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use BelongsToTenant, HasApiTokens, HasFactory, HasRoles, HasUuids, Notifiable, Searchable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'zone_id',
        'branch_id',
        'gender',
        'address',
        'qualification',
        'created_by',
    ];

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
                'tenant_id' => $user->tenant_id,
                'notifications' => [
                    'families_changes' => true,
                    'branches_and_zones_changes' => false,
                    'schools_and_lessons_changes' => false,
                    'occasions_saves' => true,
                    'financial_changes' => false,
                ],
            ]);
        });

        static::creating(function ($model) {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::deleting(function ($model) {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();
            }
        });
    }

    public function settings(): HasOne
    {
        return $this->hasOne(Settings::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function searchableAs(): string
    {
        return 'users';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('roles');
    }

    public function shouldBeSearchable(): bool
    {
        return ! $this->roles()->pluck('name')->contains('super_admin');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
        ];
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function previews(): BelongsToMany
    {
        return $this->belongsToMany(Preview::class, 'member_preview', 'user_id', 'preview_id')->using(MemberPreview::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
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
