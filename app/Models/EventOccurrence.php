<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class EventOccurrence extends Model
{
    use BelongsToTenant, HasUuids;

    protected $fillable = [
        'event_id',
        'start_date',
        'end_date',
        'tenant_id',
    ];

    public function orphans(): BelongsToMany
    {
        return $this->belongsToMany(Orphan::class, 'lesson_orphan', 'orphan_id', 'id')->using(LessonOrphan::class);
    }
}
