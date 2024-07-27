<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

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
