<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Sponsor extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'sponsor_type',
        'birth_date',
        'father_name',
        'mother_name',
        'birth_certificate_number',
        'academic_level_id',
        'function',
        'is_unemployed',
        'health_status',
        'diploma',
        'ccp',
        'gender',
        'created_by',
        'deleted_by',
    ];

    public function searchableAs(): string
    {
        return 'sponsors';
    }

    public function incomes(): HasOne
    {
        return $this->hasOne(Income::class);
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(['incomes', 'academicLevel', 'sponsorships', 'orphans']);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->getName(),
            'phone_number' => $this->phone_number,
            'sponsor_type' => $this->sponsor_type,
            'birth_date' => (int) strtotime($this->birth_date),
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'birth_certificate_number' => $this->birth_certificate_number,
            'academic_level_id' => $this->academic_level_id,
            'income' => (float) $this->incomes?->total_income,
            'orphans_count' => $this->orphans?->count(),
            'academic_level' => [
                'id' => $this->academic_level_id,
                'level' => $this->academicLevel?->level,
                'phase' => $this->academicLevel?->phase,
            ],
            'function' => $this->function,
            'health_status' => $this->health_status,
            'diploma' => $this->diploma,
            'ccp' => $this->ccp,
            'gender' => $this->gender,
            'tenant_id' => $this->tenant_id,
            'sponsorships' => [
                'medical_sponsorship' => boolval($this->sponsorships?->medical_sponsorship),
                'literacy_lessons' => boolval($this->sponsorships?->literacy_lessons),
                'direct_sponsorship' => boolval($this->sponsorships?->direct_sponsorship),
                'project_support' => boolval($this->sponsorships?->project_support),
            ],
            'created_at' => strtotime($this->created_at),
        ];
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function orphans(): HasMany
    {
        return $this->hasMany(Orphan::class);
    }

    public function academicLevel(): BelongsTo
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function formattedPhoneNumber(): string
    {
        return formatPhoneNumber($this->phone_number);
    }

    public function deleteWithRelations(): void
    {
        $this->unsearchable();

        $needs = $this->needs();

        $needs->unsearchable();

        $sponsorships = $this->sponsorships();

        $sponsorships->unsearchable();

        $sponsorships->delete();

        $needs->update([
            'deleted_by' => auth()->id(),
            'deleted_at' => now(),
        ]);

        $this->delete();
    }

    public function needs(): MorphMany
    {
        return $this->morphMany(Need::class, 'needable');
    }

    public function sponsorships(): HasOne
    {
        return $this->hasOne(SponsorSponsorship::class);
    }

    public function forceDeleteWithRelations(): void
    {
        $this->unsearchable();

        $needs = $this->needs();

        $needs->unsearchable();

        $sponsorships = $this->sponsorships();

        $sponsorships->unsearchable();

        $sponsorships->forceDelete();

        $needs->forceDelete();

        $this->forceDelete();
    }

    public function restoreWithRelations(): void
    {
        $this->searchable();

        $this->restore();

        $needs = $this->needs()->withTrashed();

        $sponsorships = $this->sponsorships()->withTrashed();

        $needs->searchable();

        $sponsorships->searchable();

        $needs->restore();

        $sponsorships->restore();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model): void {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::softDeleted(function ($model): void {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }
}
