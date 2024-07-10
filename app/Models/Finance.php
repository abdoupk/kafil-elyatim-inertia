<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Finance extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'amount',
        'description',
        'date',
        'created_by',
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'created_by' => 'string',
        ];
    }
}
