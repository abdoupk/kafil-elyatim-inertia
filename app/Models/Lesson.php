<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property int $subject_id
 * @property int $academic_level_id
 * @property string $private_school_id
 * @property int $quota
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read AcademicLevel|null $academicLevel
 * @property-read LessonOrphan $pivot
 * @property-read Collection<int, Orphan> $orphans
 * @property-read int|null $orphans_count
 * @property-read PrivateSchool $school
 * @property-read Subject|null $subject
 * @property-read Tenant|null $tenant
 *
 * @method static LessonFactory factory($count = null, $state = [])
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereAcademicLevelId($value)
 * @method static Builder|Lesson whereCreatedAt($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson wherePrivateSchoolId($value)
 * @method static Builder|Lesson whereQuota($value)
 * @method static Builder|Lesson whereSubjectId($value)
 * @method static Builder|Lesson whereTenantId($value)
 * @method static Builder|Lesson whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Lesson extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $table = 'lessons';

    protected $fillable = [
        'subject_id',
        'academic_level_id',
        'quota',
        'id',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(PrivateSchool::class, 'private_school_id', 'id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id', 'id');
    }

    public function orphans(): BelongsToMany
    {
        return $this->belongsToMany(Orphan::class, 'lesson_orphan', 'lesson_id', 'orphan_id')->using(LessonOrphan::class);
    }

    public function getName(): string
    {
        return $this->subject->getName().' - '.$this->academicLevel->level;
    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }
}
