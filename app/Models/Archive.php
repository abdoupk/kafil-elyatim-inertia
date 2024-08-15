<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    public function listBabies(): HasManyThrough
    {
        return $this->hasManyThrough(Baby::class, Archiveable::class, 'archive_id', 'id', 'id', 'archiveable_id')->with('orphan.sponsor');
    }

    public function listOrphans(): HasManyThrough
    {
        return $this->hasManyThrough(Orphan::class, Archiveable::class, 'archive_id', 'id', 'id', 'archiveable_id')->with('sponsor');
    }

    public function listFamilies(): HasManyThrough
    {
        return $this->hasManyThrough(Family::class, Archiveable::class, 'archive_id', 'id', 'id', 'archiveable_id');
    }

    public function searchableAs(): string
    {
        return 'archive';
    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
            'saved_by' => 'string',
        ];
    }
}
