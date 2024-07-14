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
        'academic_level',
        'function',
        'health_status',
        'diploma',
        'card_number',
        'tenant_id',
        'ccp',
        'gender',
        'created_by',
        'deleted_by',
    ];

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

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->getName(),
            'phone_number' => $this->phone_number,
            'sponsor_type' => $this->sponsor_type,
            'birth_date' => $this->birth_date,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'birth_certificate_number' => $this->birth_certificate_number,
            'academic_level' => $this->academic_level,
            'function' => $this->function,
            'health_status' => $this->health_status,
            'diploma' => $this->diploma,
            'card_number' => $this->card_number,
            'ccp' => $this->ccp,
            'gender' => $this->gender,
            'tenant_id' => $this->tenant_id,
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

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function needs(): MorphMany
    {
        return $this->morphMany(Need::class, 'needable');
    }

    public function orphans(): HasMany
    {
        return $this->hasMany(Orphan::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        // TODO: should be searchable error
        //        static::updated(function (Sponsor $sponsor) {
        //            $sponsor->sponsorships()->searchable();
        //        });
    }
}
