<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class PrivateSchool extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }

    public function searchableAs(): string
    {
        return 'schools';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('lessons');
    }

    public function toSearchableArray(): array
    {
        return [
            'tenant_id' => $this->tenant_id,
            'name' => $this->name,
            'quota' => $this->lessons->sum('quota'),
            'created_at' => $this->created_at,
        ];
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'private_school_id', 'id');
    }

    public function subjects()
    {
        return $this->lessons()->with('subject');
    }
}
