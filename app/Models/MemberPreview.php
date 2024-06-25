<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberPreview extends Pivot
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'member_preview';

    protected function casts(): array
    {
        return [
            'user_id' => 'string',
            'preview_id' => 'string',
        ];
    }
}
