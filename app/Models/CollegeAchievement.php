<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class CollegeAchievement extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'orphan_id',
        'first_semester',
        'second_semester',
        'speciality',
        'note',
        'university',
        'academic_level_id',
        'year',
        'average',
    ];

    protected function casts(): array
    {
        return [
            'orphan_id' => 'string',
            'tenant_id' => 'string',
        ];
    }

    public function orphans(): HasMany
    {
        return $this->hasMany(Orphan::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class);
    }
}
