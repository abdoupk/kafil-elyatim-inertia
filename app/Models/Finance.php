<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Finance extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'amount',
        'description',
        'date',
        'specification',
        'created_by',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'created_by' => 'string',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function searchableAs(): string
    {
        return 'finances';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('creator');
    }

    public function toSearchableArray(): array
    {
        return [
            'amount' => $this->amount,
            'description' => $this->description,
            'date' => $this->date,
            'specification' => [
                'ar' => __($this->specification, locale: 'ar'),
                'en' => __($this->specification, locale: 'en'),
                'fr' => __($this->specification, locale: 'fr'),
            ],
            'creator' => $this->creator->getName(),
            'tenant_id' => $this->tenant_id,
        ];
    }
}
