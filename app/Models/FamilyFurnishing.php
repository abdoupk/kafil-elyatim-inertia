<?php

namespace App\Models;

use Database\Factories\FamilyFurnishingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $family_id
 * @property string $furnishing_id
 * @property string $value
 *
 * @method static FamilyFurnishingFactory factory($count = null, $state = [])
 * @method static Builder|FamilyFurnishing newModelQuery()
 * @method static Builder|FamilyFurnishing newQuery()
 * @method static Builder|FamilyFurnishing query()
 * @method static Builder|FamilyFurnishing whereFamilyId($value)
 * @method static Builder|FamilyFurnishing whereFurnishingId($value)
 * @method static Builder|FamilyFurnishing whereId($value)
 * @method static Builder|FamilyFurnishing whereValue($value)
 *
 * @mixin Eloquent
 */
class FamilyFurnishing extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'family_furnishing';
}
