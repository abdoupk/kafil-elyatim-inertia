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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'academic_level_id',
        'academic_year',
        'shoes_size',
        'pants_size',
        'shirt_size',
        'note',
        'family_id',
        'sponsor_id',
        'created_by',
        'deleted_by',
        'deleted_at',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function sponsorships(): HasOne
    {
        return $this->hasOne(OrphanSponsorship::class);
    }

    public function shoesSize(): BelongsTo
    {
        return $this->belongsTo(ShoeSize::class, 'shoes_size', 'id');
    }

    public function pantsSize(): BelongsTo
    {
        return $this->belongsTo(ClothesSize::class, 'pants_size', 'id');
    }

    public function shirtSize(): BelongsTo
    {
        return $this->belongsTo(ClothesSize::class, 'shirt_size', 'id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->getName(),
            'birth_date' => $this->birth_date,
            'health_status' => $this->health_status,
            'family_status' => $this->family_status,
            'shoes_size' => $this->shoes_size,
            'shirt_size' => $this->shirt_size,
            'pants_size' => $this->pants_size,
            'note' => $this->note,
            'academic_level' => [
                'id' => $this->academic_level_id,
                'level' => $this->academicLevel->level,
                'phase' => $this->academicLevel->phase,
            ],
            'academic_achievements' => $this->academicAchievements->map(function (AcademicAchievement $academicAchievement) {
                return [
                    'id' => $academicAchievement->id,
                    'academic_level' => $academicAchievement->academicLevel->level,
                    'academic_year' => $academicAchievement->academic_year,
                    'first_trimester' => (float) number_format($academicAchievement->first_trimester, 2),
                    'second_trimester' => (float) number_format($academicAchievement->second_trimester, 2),
                    'third_trimester' => (float) number_format($academicAchievement->third_trimester, 2),
                    'average' => (float) number_format($academicAchievement->average, 2),
                ];
            })->toArray(),
            'college_achievements' => $this->collegeAchievements->map(function (CollegeAchievement $collegeAchievement) {
                return [
                    'id' => $collegeAchievement->id,
                    'academic_level' => $collegeAchievement->academicLevel->level,
                    'academic_year' => $collegeAchievement->year,
                    'first_semester' => (float) number_format($collegeAchievement->first_semester, 2),
                    'second_semester' => (float) number_format($collegeAchievement->second_semester, 2),
                    'average' => (float) number_format($collegeAchievement->average, 2),
                    'speciality' => $collegeAchievement->speciality,
                    'university' => $collegeAchievement->university,
                ];
            })->toArray(),
            'vocational_training_achievements' => $this->vocationalTrainingAchievements->map(function (VocationalTrainingAchievement $vocationalTrainingAchievement) {
                return [
                    'id' => $vocationalTrainingAchievement->id,
                    'vocational_training_speciality' => $vocationalTrainingAchievement->vocationalTraining->speciality,
                    'vocational_training_division' => $vocationalTrainingAchievement->vocationalTraining->division,
                    'institute' => $vocationalTrainingAchievement->institute,
                ];
            })->toArray(),
            'tenant_id' => $this->tenant_id,
            'family_id' => $this->family_id,
        ];
    }

    public function searchableAs(): string
    {
        return 'orphans';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(['academicLevel', 'academicAchievements.academicLevel', 'collegeAchievements.academicLevel', 'vocationalTrainingAchievements.vocationalTraining']);
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

    public function lastAcademicYearAchievement(): HasOne
    {
        return $this->hasOne(AcademicAchievement::class, 'orphan_id')
            ->where(function ($query) {
                $query->whereRaw('academic_achievements.academic_year = ?', now()->year)
                    ->orWhereRaw('academic_achievements.academic_year = ? ', now()->year - 1);
            })
            ->latest('academic_achievements.academic_year');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function needs(): MorphMany
    {
        return $this->morphMany(Need::class, 'needable');
    }

    public function babyNeeds(): HasOne
    {
        return $this->hasOne(Baby::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(EventOccurrence::class, 'event_occurrences', 'lesson_id', 'id')->using(LessonOrphan::class);
    }

    public function vocationalTrainingAchievements(): HasMany
    {
        return $this->hasMany(VocationalTrainingAchievement::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(EventOccurrence::class, 'event_occurrence_orphan', 'orphan_id', 'event_occurrence_id');
    }

    public function collegeAchievements(): HasMany
    {
        return $this->hasMany(CollegeAchievement::class);
    }

    public function formatedLastAcademicYear(): string
    {
        //handle academic level is emp
        if (is_null($this->lastAcademicYearAchievement)) {
            return '';
        }

        return $this->lastAcademicYearAchievement?->academicLevel->level.' ('.$this->lastAcademicYearAchievement?->academic_year.')';
    }
}
