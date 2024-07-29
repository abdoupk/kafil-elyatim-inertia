<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class LessonOrphan extends Pivot
{
    use BelongsToTenant, HasUuids;

    protected $table = 'lesson_orphan';

    public $timestamps = false;

    public $incrementing = false;

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
