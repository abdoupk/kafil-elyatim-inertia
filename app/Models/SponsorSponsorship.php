<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class SponsorSponsorship extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'sponsor_id',
        'medical_sponsorship',
        'literacy_lessons',
        'direct_sponsorship',
        'project_support',
    ];

    protected $table = 'sponsor_sponsorship';

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function searchableAs(): string
    {
        return 'sponsor_sponsorships';
    }
}
