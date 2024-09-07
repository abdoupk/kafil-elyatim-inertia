<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Spouse extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'death_date',
        'function',
        'income',
        'family_id',
    ];

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'death_date' => 'date',
        ];
    }
}
