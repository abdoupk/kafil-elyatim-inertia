<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class EventOccurrence extends Model
{
    use BelongsToTenant, HasUuids;

    protected $fillable = [
        'event_id',
        'start_date',
        'end_date',
        'tenant_id',
    ];
}
