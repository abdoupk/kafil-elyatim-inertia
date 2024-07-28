<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class vocationalTrainingAchievement extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'orphan_id',
        'tenant_id',
        'note',
        'year',
        'vocational_training_id',
    ];

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }

    public function vocationalTraining(): BelongsTo
    {
        return $this->belongsTo(VocationalTraining::class);
    }
}
