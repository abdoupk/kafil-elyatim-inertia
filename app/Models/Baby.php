<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Baby extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'baby_milk_quantity',
        'baby_milk_type',
        'diapers_quantity',
        'diapers_type',
        'tenant_id',
        'orphan_id',
        'family_id',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
            'orphan_id' => 'string',
        ];
    }
}
