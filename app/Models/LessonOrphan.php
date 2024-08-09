<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $lesson_id
 * @property string $orphan_id
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Tenant|null $tenant
 *
 * @method static Builder|LessonOrphan newModelQuery()
 * @method static Builder|LessonOrphan newQuery()
 * @method static Builder|LessonOrphan query()
 * @method static Builder|LessonOrphan whereCreatedAt($value)
 * @method static Builder|LessonOrphan whereId($value)
 * @method static Builder|LessonOrphan whereLessonId($value)
 * @method static Builder|LessonOrphan whereOrphanId($value)
 * @method static Builder|LessonOrphan whereTenantId($value)
 * @method static Builder|LessonOrphan whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class LessonOrphan extends Pivot
{
    use BelongsToTenant, HasUuids, SoftDeletes;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'lesson_orphan';

    protected $fillable = [
        'lesson_id',
        'orphan_id',
    ];

    protected function casts(): array
    {
        return [
            'lesson_id' => 'string',
            'orphan_id' => 'string',
        ];
    }
}
