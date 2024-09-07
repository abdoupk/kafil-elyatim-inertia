<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class OrphanSponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'orphan_id',
        'medical_sponsorship',
        'university_scholarship',
        'association_trips',
        'summer_camp',
        'eid_suit',
        'private_lessons',
        'school_bag',
    ];

    protected $table = 'orphan_sponsorship';

    public function orphan(): BelongsTo
    {
        return $this->belongsTo(Orphan::class);
    }

    public function searchableAs(): string
    {
        return 'orphan_sponsorships';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load('orphan.academicLevel', 'orphan.sponsor', 'orphan.family', 'orphan.family.zone', 'orphan.lastAcademicYearAchievement');
    }

    public function toSearchableArray(): array
    {
        return [
            'medical_sponsorship' => $this->medical_sponsorship,
            'university_scholarship' => $this->university_scholarship,
            'association_trips' => $this->association_trips,
            'summer_camp' => $this->summer_camp,
            'eid_suit' => $this->eid_suit,
            'private_lessons' => $this->private_lessons,
            'school_bag' => $this->school_bag,
            'family' => [
                'address' => $this->orphan->family?->address,
                'zone' => $this->orphan->family?->zone->name,
            ],
            'orphan' => [
                'id' => $this->orphan->id,
                'gender' => $this->orphan->gender,
                'age' => $this->orphan->birth_date->age ?? null,
                'name' => $this->orphan->getName(),
                'birth_date' => strtotime($this->orphan->birth_date),
                'academic_achievement' => [
                    'academic_level' => $this->orphan->academicLevel,
                    'academic_year' => $this->orphan->lastAcademicYearAchievement?->academic_year,
                    'last_year_average' => (float) $this->orphan->lastAcademicYearAchievement?->average,
                ],
                'year_average' => (float) $this->orphan?->lastAcademicYearAchievement?->average,
                'shirt_size' => $this->orphan->shirt_size,
                'pants_size' => $this->orphan->pants_size,
                'shoes_size' => $this->orphan->shoes_size,
            ],
            'sponsor' => [
                'name' => $this->orphan->sponsor?->getName(),
                'phone_number' => $this->orphan->sponsor?->formattedPhoneNumber(),
            ],
            'tenant_id' => $this->orphan->tenant_id,
        ];
    }

    public function archives(): MorphToMany
    {
        return $this->morphToMany(Archive::class, 'archiveable');
    }
}
