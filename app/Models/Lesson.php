<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Lesson extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $table = 'lessons';

    protected $fillable = [
        'subject_id',
        'academic_level_id',
        'quota',
        'id',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }

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
        return $this->belongsToMany(Orphan::class, 'lesson_orphan', 'lesson_id', 'orphan_id');
    }
}
