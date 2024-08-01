<?php

namespace App\Models;

use Database\Factories\PrivateSchoolFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $name
 * @property string $tenant_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Lesson> $lessons
 * @property-read int|null $lessons_count
 * @property-read Tenant $tenant
 *
 * @method static PrivateSchoolFactory factory($count = null, $state = [])
 * @method static Builder|PrivateSchool newModelQuery()
 * @method static Builder|PrivateSchool newQuery()
 * @method static Builder|PrivateSchool onlyTrashed()
 * @method static Builder|PrivateSchool query()
 * @method static Builder|PrivateSchool whereCreatedAt($value)
 * @method static Builder|PrivateSchool whereDeletedAt($value)
 * @method static Builder|PrivateSchool whereId($value)
 * @method static Builder|PrivateSchool whereName($value)
 * @method static Builder|PrivateSchool whereTenantId($value)
 * @method static Builder|PrivateSchool whereUpdatedAt($value)
 * @method static Builder|PrivateSchool withTrashed()
 * @method static Builder|PrivateSchool withoutTrashed()
 *
 * @mixin Eloquent
 */
class PrivateSchool extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
    ];

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

    public function subjects()
    {
        return $this->lessons()->with('subject');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'private_school_id', 'id');
    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }
}
