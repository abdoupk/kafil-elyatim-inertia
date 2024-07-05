<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Need extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'demand',
        'status',
        'note',
    ];

    public function needable(): MorphTo
    {
        return $this->morphTo();
    }
}
