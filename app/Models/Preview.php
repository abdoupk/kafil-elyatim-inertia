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
