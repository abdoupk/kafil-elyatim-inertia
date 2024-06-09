<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $birth_date
 * @property string $death_date
 * @property string $function
 * @property float $income
 * @property string $family_id
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static Builder|Spouse newModelQuery()
 * @method static Builder|Spouse newQuery()
 * @method static Builder|Spouse query()
 * @method static Builder|Spouse whereBirthDate($value)
 * @method static Builder|Spouse whereCreatedAt($value)
 * @method static Builder|Spouse whereDeathDate($value)
 * @method static Builder|Spouse whereFamilyId($value)
 * @method static Builder|Spouse whereFirstName($value)
 * @method static Builder|Spouse whereFunction($value)
 * @method static Builder|Spouse whereIncome($value)
 * @method static Builder|Spouse whereLastName($value)
 * @method static Builder|Spouse whereTenantId($value)
 * @method static Builder|Spouse whereUpdatedAt($value)
 *
 * @property int $id
 *
 * @method static Builder|Spouse whereId($value)
 * @method static \Database\Factories\SpouseFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
class Spouse extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;
}
