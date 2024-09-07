<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

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
