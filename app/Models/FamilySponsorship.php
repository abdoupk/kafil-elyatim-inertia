<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FamilySponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    public $timestamps = false;

    protected $table = 'family_sponsorship';

    protected $fillable = [
        //        'family_id',
        'monthly_allowance',
        'ramadan_basket',
        'zakat',
        'housing_assistance',
        'eid_al_adha',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function orphans(): HasManyThrough
    {
        return $this->hasManyThrough(Orphan::class, Family::class, 'id', 'family_id', 'family_id', 'id');
    }

    public function searchableAs(): string
    {
        return 'family_sponsorships';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load(
            'family.sponsor.incomes',
            'family.zone',
            'family.orphans',
            'family.secondSponsor',
            'family.branch'
        );
    }

    public function toSearchableArray(): array
    {
        return [
            'monthly_allowance' => $this->monthly_allowance,
            'ramadan_basket' => $this->ramadan_basket,
            'zakat' => $this->zakat,
            'housing_assistance' => $this->housing_assistance,
            'eid_al_adha' => $this->eid_al_adha,
            'family' => [
                'address' => $this->family->address,
                'zone' => [
                    'id' => $this->family->zone?->id,
                    'name' => $this->family->zone?->name,
                ],
                'branch' => [
                    'id' => $this->family->branch->id,
                    'name' => $this->family->branch->name,
                ],
                'orphans_count' => $this->family->orphans->count(),
                'income_rate' => (float) $this->family->income_rate,
                'total_income' => $this->family->total_income,
            ],
            'sponsor' => [
                'name' => $this->family->sponsor?->getName(),
                'phone_number' => $this->family->sponsor?->phone_number,
            ],
            'tenant_id' => $this->tenant_id,
            'created_at' => $this->created_at,
        ];
    }
}
