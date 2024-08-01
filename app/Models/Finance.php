<?php

namespace App\Models;

use Database\Factories\FinanceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property float $amount
 * @property string|null $description
 * @property Carbon $date
 * @property string $specification
 * @property string $created_by
 * @property string $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $creator
 * @property-read Tenant|null $tenant
 *
 * @method static FinanceFactory factory($count = null, $state = [])
 * @method static Builder|Finance newModelQuery()
 * @method static Builder|Finance newQuery()
 * @method static Builder|Finance query()
 * @method static Builder|Finance whereAmount($value)
 * @method static Builder|Finance whereCreatedAt($value)
 * @method static Builder|Finance whereCreatedBy($value)
 * @method static Builder|Finance whereDate($value)
 * @method static Builder|Finance whereDescription($value)
 * @method static Builder|Finance whereId($value)
 * @method static Builder|Finance whereSpecification($value)
 * @method static Builder|Finance whereTenantId($value)
 * @method static Builder|Finance whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Finance extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'amount',
        'description',
        'date',
        'specification',
        'created_by',
    ];

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

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'created_by' => 'string',
        ];
    }
}
