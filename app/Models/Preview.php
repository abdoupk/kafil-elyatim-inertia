<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $report
 * @property \Illuminate\Support\Carbon $preview_date
 * @property string $family_id
 * @property string $tenant_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family|null $family
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $inspectors
 * @property-read int|null $inspectors_count
 * @property-read \App\Models\Tenant|null $tenant
 *
 * @method static \Database\Factories\PreviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Preview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview query()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview wherePreviewDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preview withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Preview withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Preview extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes, SoftDeletes;

    protected $table = 'previews';

    protected $fillable = [
        'report',
        'preview_date',
        'family_id',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'preview_date' => 'date',
            'family_id' => 'string',
            'tenant_id' => 'string',
        ];
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function inspectors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'member_preview', 'preview_id', 'user_id')->using(MemberPreview::class);
    }
}
