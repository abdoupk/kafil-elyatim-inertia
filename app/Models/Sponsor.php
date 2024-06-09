<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Income> $incomes
 * @property-read int|null $incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SponsorSponsorship> $sponsorships
 * @property-read int|null $sponsorships_count
 *
 * @method static \Database\Factories\SponsorFactory factory($count = null, $state = [])
 * @method static Builder|Sponsor whereBirthCertificateNumber($value)
 * @method static Builder|Sponsor whereCardNumber($value)
 * @method static Builder|Sponsor whereFileNumber($value)
 * @method static Builder|Sponsor whereZoneId($value)
 *
 * @mixin Eloquent
 */
class Sponsor extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    public function incomes(): BelongsToMany
    {
        return $this->belongsToMany(Income::class)->using(IncomeSponsor::class);
    }

    public function sponsorships(): HasMany
    {
        return $this->hasMany(SponsorSponsorship::class);
    }
}
