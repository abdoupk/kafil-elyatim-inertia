<?php

namespace App\Models;

use Database\Factories\EventOccurrenceOrphanFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $event_occurrence_id
 * @property string $lesson_id
 * @property string $orphan_id
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Tenant|null $tenant
 *
 * @method static EventOccurrenceOrphanFactory factory($count = null, $state = [])
 * @method static Builder|EventOccurrenceOrphan newModelQuery()
 * @method static Builder|EventOccurrenceOrphan newQuery()
 * @method static Builder|EventOccurrenceOrphan query()
 * @method static Builder|EventOccurrenceOrphan whereCreatedAt($value)
 * @method static Builder|EventOccurrenceOrphan whereEventOccurrenceId($value)
 * @method static Builder|EventOccurrenceOrphan whereId($value)
 * @method static Builder|EventOccurrenceOrphan whereLessonId($value)
 * @method static Builder|EventOccurrenceOrphan whereOrphanId($value)
 * @method static Builder|EventOccurrenceOrphan whereTenantId($value)
 * @method static Builder|EventOccurrenceOrphan whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class EventOccurrenceOrphan extends Pivot
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'event_occurrence_id',
        'lesson_id',
        'orphan_id',
    ];

    protected $table = 'event_occurrence_orphan';
}
