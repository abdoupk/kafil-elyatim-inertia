<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Zone extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $table = 'zones';

    protected $fillable = ['name', 'description', 'created_by', 'deleted_by'];

    public function searchableAs(): string
    {
        return 'zones';
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->loadCount('families');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'families_count' => $this->families_count,
            'tenant_id' => $this->tenant_id,
            'description' => $this->description,
            'created_at' => strtotime($this->created_at),
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::softDeleted(function ($model) {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();

                $model->save();
            }
        });
    }
}
