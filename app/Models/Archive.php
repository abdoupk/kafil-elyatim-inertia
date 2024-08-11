<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Archive extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'occasion',
        'tenant_id',
        'families_count',
        'family_ids',
        'saved_by',
        'saved_month',
    ];

    //    public static function boot(): void
    //    {
    //        static::creating(function ($model) {
    //            $model->saved_by = auth()->user()->id;
    //        });
    //    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
            'family_ids' => 'array',
            'saved_by' => 'string',
        ];
    }
}
