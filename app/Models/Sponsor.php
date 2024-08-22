<?php

namespace App\Models;

use Database\Factories\SponsorFactory;
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
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int $id
 * @property int $zone
 * @property int $number
 * @property string $start_date
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $sponsorship_type
 * @property string $birth_date
 * @property string $father_name
 * @property string $mother_name
 * @property string $birth_certificate
 * @property string $academic_level
 * @property string $function
 * @property string $health_status
 * @property string|null $diploma
 * @property string $tenant_id
 * @property string $created_by
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static Builder|Sponsor newModelQuery()
 * @method static Builder|Sponsor newQuery()
 * @method static Builder|Sponsor query()
 * @method static Builder|Sponsor whereAcademicLevel($value)
 * @method static Builder|Sponsor whereAddress($value)
 * @method static Builder|Sponsor whereBirthCertificate($value)
 * @method static Builder|Sponsor whereBirthDate($value)
 * @method static Builder|Sponsor whereCreatedAt($value)
 * @method static Builder|Sponsor whereCreatedBy($value)
 * @method static Builder|Sponsor whereDeletedAt($value)
 * @method static Builder|Sponsor whereDeletedBy($value)
 * @method static Builder|Sponsor whereDiploma($value)
 * @method static Builder|Sponsor whereFatherName($value)
 * @method static Builder|Sponsor whereFunction($value)
 * @method static Builder|Sponsor whereHealthStatus($value)
 * @method static Builder|Sponsor whereId($value)
 * @method static Builder|Sponsor whereMotherName($value)
 * @method static Builder|Sponsor whereName($value)
 * @method static Builder|Sponsor whereNumber($value)
 * @method static Builder|Sponsor wherePhoneNumber($value)
 * @method static Builder|Sponsor whereSponsorshipType($value)
 * @method static Builder|Sponsor whereStartDate($value)
 * @method static Builder|Sponsor whereTenantId($value)
 * @method static Builder|Sponsor whereUpdatedAt($value)
 * @method static Builder|Sponsor whereZone($value)
 *
 * @property string $zone_id
 * @property int $file_number
 * @property string $birth_certificate_number
 * @property string|null $card_number
 * @property-read Collection<int, Income> $incomes
 * @property-read int|null $incomes_count
 * @property-read Collection<int, SponsorSponsorship> $sponsorships
 * @property-read int|null $sponsorships_count
 *
 * @method static SponsorFactory factory($count = null, $state = [])
 * @method static Builder|Sponsor whereBirthCertificateNumber($value)
 * @method static Builder|Sponsor whereCardNumber($value)
 * @method static Builder|Sponsor whereFileNumber($value)
 * @method static Builder|Sponsor whereZoneId($value)
 *
 * @property string $first_name
 * @property string $last_name
 *
 * @method static Builder|Sponsor whereFirstName($value)
 * @method static Builder|Sponsor whereLastName($value)
 *
 * @property string $sponsor_type
 * @property string|null $ccp
 * @property string $gender
 * @property string $family_id
 * @property-read Tenant $tenant
 *
 * @method static Builder|Sponsor onlyTrashed()
 * @method static Builder|Sponsor whereCcp($value)
 * @method static Builder|Sponsor whereFamilyId($value)
 * @method static Builder|Sponsor whereGender($value)
 * @method static Builder|Sponsor whereSponsorType($value)
 * @method static Builder|Sponsor withTrashed()
 * @method static Builder|Sponsor withoutTrashed()
 *
 * @property-read User $creator
 * @property int $academic_level_id
 * @property-read AcademicLevel|null $academicLevel
 * @property-read Family $family
 * @property-read Collection<int, Need> $needs
 * @property-read int|null $needs_count
 * @property-read Collection<int, Orphan> $orphans
 * @property-read int|null $orphans_count
 *
 * @method static Builder|Sponsor whereAcademicLevelId($value)
 *
 * @mixin Eloquent
 */
class Sponsor extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'sponsor_type',
        'birth_date',
        'father_name',
        'mother_name',
        'birth_certificate_number',
        'academic_level_id',
        'function',
        'health_status',
        'diploma',
        'ccp',
        'gender',
        'created_by',
        'deleted_by',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::softDeleted(function ($model) {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();
            }
        });
    }

    public function searchableAs(): string
    {
        return 'sponsors';
    }

    public function incomes(): HasOne
    {
        return $this->hasOne(Income::class);
    }

    public function sponsorships(): HasOne
    {
        return $this->hasOne(SponsorSponsorship::class);
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(['incomes', 'academicLevel', 'sponsorships', 'orphans']);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->getName(),
            'phone_number' => $this->phone_number,
            'sponsor_type' => $this->sponsor_type,
            'birth_date' => strtotime($this->birth_date),
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'birth_certificate_number' => $this->birth_certificate_number,
            'academic_level_id' => $this->academic_level_id,
            'income' => (float) $this->incomes?->total_income,
            'orphans_count' => $this->orphans?->count(),
            'academic_level' => [
                'id' => $this->academic_level_id,
                'level' => $this->academicLevel?->level,
                'phase' => $this->academicLevel?->phase,
            ],
            'function' => $this->function,
            'health_status' => $this->health_status,
            'diploma' => $this->diploma,
            'ccp' => $this->ccp,
            'gender' => $this->gender,
            'tenant_id' => $this->tenant_id,
            'sponsorships' => [
                'medical_sponsorship' => boolval($this->sponsorships?->medical_sponsorship),
                'literacy_lessons' => boolval($this->sponsorships?->literacy_lessons),
                'direct_sponsorship' => boolval($this->sponsorships?->direct_sponsorship),
                'project_support' => boolval($this->sponsorships?->project_support),
            ],
        ];
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function needs(): MorphMany
    {
        return $this->morphMany(Need::class, 'needable');
    }

    public function orphans(): HasMany
    {
        return $this->hasMany(Orphan::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function formattedPhoneNumber(): string
    {
        return formatPhoneNumber($this->phone_number);
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }
}
