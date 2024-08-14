<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Archive extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'occasion',
        'tenant_id',
        'saved_by',
    ];

    public function savedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'saved_by');
    }

    public function families(): MorphToMany
    {
        return $this->morphedByMany(Family::class, 'archiveable');
    }

    public function orphans(): MorphToMany
    {
        return $this->morphedByMany(Orphan::class, 'archiveable');
    }

    public function babies(): MorphToMany
    {
        return $this->morphedByMany(Baby::class, 'archiveable');
    }

    public function searchableAs(): string
    {
        return 'archive';
    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
            'family_ids' => 'array',
            'saved_by' => 'string',
        ];
    }
}
