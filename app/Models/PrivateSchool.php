<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class PrivateSchool extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'tenant_id',
        'quota',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }

    public function searchableAs(): string
    {
        return 'schools';
    }

    public function toSearchableArray(): array
    {
        return [
            'tenant_id' => $this->tenant_id,
            'name' => $this->name,
        ];
    }
}
