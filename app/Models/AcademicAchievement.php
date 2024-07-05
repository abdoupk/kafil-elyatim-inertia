<?php

namespace App\Models;

use Database\Factories\AcademicAchievementFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @method static AcademicAchievementFactory factory($count = null, $state = [])
 * @method static Builder|AcademicAchievement newModelQuery()
 * @method static Builder|AcademicAchievement newQuery()
 * @method static Builder|AcademicAchievement query()
 *
 * @mixin Eloquent
 */
class AcademicAchievement extends Model
{
    use BelongsToTenant, HasFactory, Hasuuids;

    protected $fillable = [
        'orphan_id',
        'academic_level',
        'first_trimester',
        'second_trimester',
        'third_trimester',
        'total',
        'first_semester',
        'second_semester',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'orphan_id' => 'string',
            'tenant_id' => 'string',
        ];
    }

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }
}
