<?php

namespace App\Models;

use Database\Factories\OrphanFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birth_date
 * @property string $family_status
 * @property string $health_status
 * @property string $academic_level
 * @property string $shoes_size
 * @property string $pants_size
 * @property string $shirt_size
 * @property string $note
 * @property string $tenant_id
 * @property string $family_id
 * @property string $created_by
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static OrphanFactory factory($count = null, $state = [])
 * @method static Builder|Orphan newModelQuery()
 * @method static Builder|Orphan newQuery()
 * @method static Builder|Orphan query()
 * @method static Builder|Orphan whereAcademicLevel($value)
 * @method static Builder|Orphan whereBirthDate($value)
 * @method static Builder|Orphan whereCreatedAt($value)
 * @method static Builder|Orphan whereCreatedBy($value)
 * @method static Builder|Orphan whereDeletedBy($value)
 * @method static Builder|Orphan whereFamilyId($value)
 * @method static Builder|Orphan whereFamilyStatus($value)
 * @method static Builder|Orphan whereFirstName($value)
 * @method static Builder|Orphan whereHealthStatus($value)
 * @method static Builder|Orphan whereId($value)
 * @method static Builder|Orphan whereLastName($value)
 * @method static Builder|Orphan whereNote($value)
 * @method static Builder|Orphan wherePantsSize($value)
 * @method static Builder|Orphan whereShirtSize($value)
 * @method static Builder|Orphan whereShoesSize($value)
 * @method static Builder|Orphan whereTenantId($value)
 * @method static Builder|Orphan whereUpdatedAt($value)
 *
 * @property-read Family $family
 * @property-read Collection<int, OrphanSponsorship> $sponsorships
 * @property-read int|null $sponsorships_count
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|Orphan onlyTrashed()
 * @method static Builder|Orphan whereDeletedAt($value)
 * @method static Builder|Orphan withTrashed()
 * @method static Builder|Orphan withoutTrashed()
 *
 * @property-read Tenant $tenant
 * @property string $gender
 *
 * @method static Builder|Orphan whereGender($value)
 *
 * @mixin Eloquent
 */
class Orphan extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'family_status',
        'health_status',
        'academic_level',
        'shoes_size',
        'pants_size',
        'shirt_size',
        'note',
        'tenant_id',
        'family_id',
        'created_by',
        'deleted_by',
        'deleted_at',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function sponsorships(): HasOne
    {
        return $this->hasOne(OrphanSponsorship::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->getName(),
            'birth_date' => $this->birth_date,
            'academic_level' => $this->academic_level,
            'health_status' => $this->health_status,
            'family_status' => $this->family_status,
            'shoes_size' => $this->shoes_size,
            'shirt_size' => $this->shirt_size,
            'pants_size' => $this->pants_size,
            'note' => $this->note,
            'tenant_id' => $this->tenant_id,
            'family_id' => $this->family_id,
        ];
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function academicAchievements(): HasMany
    {
        return $this->hasMany(AcademicAchievement::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function needs(): MorphMany
    {
        return $this->morphMany(Need::class, 'needable');
    }
}
