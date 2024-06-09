<?php

namespace App\Models;

use Database\Factories\BenefactorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $tenant_id
 * @property string|null $deleted_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static BenefactorFactory factory($count = null, $state = [])
 * @method static Builder|Benefactor newModelQuery()
 * @method static Builder|Benefactor newQuery()
 * @method static Builder|Benefactor query()
 * @method static Builder|Benefactor whereCreatedAt($value)
 * @method static Builder|Benefactor whereDeletedAt($value)
 * @method static Builder|Benefactor whereId($value)
 * @method static Builder|Benefactor whereTenantId($value)
 * @method static Builder|Benefactor whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Benefactor extends Model
{
    use HasFactory;

    public $timestamps = false;
}
