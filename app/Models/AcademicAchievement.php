<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class AcademicAchievement extends Model
{
    use BelongsToTenant, HasFactory, Hasuuids, SoftDeletes;

    protected $fillable = [
        'orphan_id',
        'academic_level_id',
        'academic_year',
        'first_trimester',
        'second_trimester',
        'third_trimester',
        'average',
        'first_semester',
        'second_semester',
        'note',
    ];

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    protected function casts(): array
    {
        return [
            'orphan_id' => 'string',
            'tenant_id' => 'string',
        ];
    }
}
