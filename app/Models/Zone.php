<?php

namespace App\Models;

use Database\Factories\ZoneFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 *
 * @method static ZoneFactory factory($count = null, $state = [])
 * @method static Builder|Zone newModelQuery()
 * @method static Builder|Zone newQuery()
 * @method static Builder|Zone query()
 * @method static Builder|Zone whereId($value)
 * @method static Builder|Zone whereName($value)
 *
 * @mixin Eloquent
 */
class Zone extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'zones';
}
