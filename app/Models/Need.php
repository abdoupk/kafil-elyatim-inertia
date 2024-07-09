<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Need extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'demand',
        'status',
        'subject',
        'note',
        'tenant_id',
        'needable_id',
        'needable_type',
    ];

    public function needable(): MorphTo
    {
        return $this->morphTo();
    }

    public function searchableAs(): string
    {
        return 'needs';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(['needable']);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'demand' => $this->demand,
            'status' => $this->status,
            'needable' => [
                'id' => $this->needable_id,
                'name' => $this->needable->getName(),
                'type' => $this->needable_type,
            ],
            'note' => $this->note,
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
        ];
    }
}
