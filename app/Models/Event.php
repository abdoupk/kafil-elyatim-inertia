<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use MohammedManssour\LaravelRecurringModels\Concerns\Repeatable;
use MohammedManssour\LaravelRecurringModels\Contracts\Repeatable as RepeatableContract;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Event extends Model implements RepeatableContract
{
    use BelongsToTenant, HasFactory, HasUuids, Repeatable, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'until',
        'frequency',
        'interval',
        'subject_id',
        'school_id',
        'start_date',
        'end_date',
        'color',
    ];

    protected function casts(): array
    {
        return [
            'school_id' => 'string',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(PrivateSchool::class);
    }

    public function occurrences(): HasMany
    {
        return $this->hasMany(EventOccurrence::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
