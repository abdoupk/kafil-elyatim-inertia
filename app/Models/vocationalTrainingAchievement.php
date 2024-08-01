<?php

namespace App\Models;

use Database\Factories\vocationalTrainingAchievementFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property string $id
 * @property string $tenant_id
 * @property string $orphan_id
 * @property string|null $note
 * @property int $year
 * @property int $vocational_training_id
 * @property string $institute
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Orphan $orphan
 * @property-read Tenant $tenant
 * @property-read VocationalTraining|null $vocationalTraining
 *
 * @method static vocationalTrainingAchievementFactory factory($count = null, $state = [])
 * @method static Builder|vocationalTrainingAchievement newModelQuery()
 * @method static Builder|vocationalTrainingAchievement newQuery()
 * @method static Builder|vocationalTrainingAchievement onlyTrashed()
 * @method static Builder|vocationalTrainingAchievement query()
 * @method static Builder|vocationalTrainingAchievement whereCreatedAt($value)
 * @method static Builder|vocationalTrainingAchievement whereDeletedAt($value)
 * @method static Builder|vocationalTrainingAchievement whereId($value)
 * @method static Builder|vocationalTrainingAchievement whereInstitute($value)
 * @method static Builder|vocationalTrainingAchievement whereNote($value)
 * @method static Builder|vocationalTrainingAchievement whereOrphanId($value)
 * @method static Builder|vocationalTrainingAchievement whereTenantId($value)
 * @method static Builder|vocationalTrainingAchievement whereUpdatedAt($value)
 * @method static Builder|vocationalTrainingAchievement whereVocationalTrainingId($value)
 * @method static Builder|vocationalTrainingAchievement whereYear($value)
 * @method static Builder|vocationalTrainingAchievement withTrashed()
 * @method static Builder|vocationalTrainingAchievement withoutTrashed()
 *
 * @mixin Eloquent
 */
class vocationalTrainingAchievement extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'orphan_id',
        'note',
        'year',
        'vocational_training_id',
        'institute',
    ];

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }

    public function vocationalTraining(): BelongsTo
    {
        return $this->belongsTo(VocationalTraining::class);
    }
}
