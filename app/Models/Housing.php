<?php

namespace App\Models;

use Database\Factories\HousingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 *
 * @method static HousingFactory factory($count = null, $state = [])
 * @method static Builder|Housing newModelQuery()
 * @method static Builder|Housing newQuery()
 * @method static Builder|Housing query()
 * @method static Builder|Housing whereId($value)
 * @method static Builder|Housing whereName($value)
 *
 * @mixin Eloquent
 */
class Housing extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;
}
