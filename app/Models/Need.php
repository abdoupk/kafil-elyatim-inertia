<?php

namespace App\Models;

use Database\Factories\NeedFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $demand
 * @property string $subject
 * @property string $status
 * @property string $needable_type
 * @property string $needable_id
 * @property string $tenant_id
 * @property string|null $note
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $needable
 * @property-read Tenant $tenant
 *
 * @method static NeedFactory factory($count = null, $state = [])
 * @method static Builder|Need newModelQuery()
 * @method static Builder|Need newQuery()
 * @method static Builder|Need query()
 * @method static Builder|Need whereCreatedAt($value)
 * @method static Builder|Need whereDeletedAt($value)
 * @method static Builder|Need whereDemand($value)
 * @method static Builder|Need whereId($value)
 * @method static Builder|Need whereNeedableId($value)
 * @method static Builder|Need whereNeedableType($value)
 * @method static Builder|Need whereNote($value)
 * @method static Builder|Need whereStatus($value)
 * @method static Builder|Need whereSubject($value)
 * @method static Builder|Need whereTenantId($value)
 * @method static Builder|Need whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Need extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'demand',
        'status',
        'subject',
        'note',
        'created_by',
        'deleted_by',
        'needable_id',
        'needable_type',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::deleting(function ($model) {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();
            }
        });
    }

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
