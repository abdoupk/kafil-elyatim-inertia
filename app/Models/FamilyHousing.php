<?php

namespace App\Models;

use Database\Factories\FamilyHousingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $family_id
 * @property string $housing_id
 * @property string $value
 *
 * @method static FamilyHousingFactory factory($count = null, $state = [])
 * @method static Builder|FamilyHousing newModelQuery()
 * @method static Builder|FamilyHousing newQuery()
 * @method static Builder|FamilyHousing query()
 * @method static Builder|FamilyHousing whereFamilyId($value)
 * @method static Builder|FamilyHousing whereHousingId($value)
 * @method static Builder|FamilyHousing whereId($value)
 * @method static Builder|FamilyHousing whereValue($value)
 *
 * @mixin Eloquent
 */
class FamilyHousing extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'family_housing';
}
