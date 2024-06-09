<?php

namespace App\Models;

use Database\Factories\IncomeSponsorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property string $income_id
 * @property string $sponsor_id
 * @property string $tenant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static IncomeSponsorFactory factory($count = null, $state = [])
 * @method static Builder|IncomeSponsor newModelQuery()
 * @method static Builder|IncomeSponsor newQuery()
 * @method static Builder|IncomeSponsor query()
 * @method static Builder|IncomeSponsor whereCreatedAt($value)
 * @method static Builder|IncomeSponsor whereId($value)
 * @method static Builder|IncomeSponsor whereIncomeId($value)
 * @method static Builder|IncomeSponsor whereSponsorId($value)
 * @method static Builder|IncomeSponsor whereTenantId($value)
 * @method static Builder|IncomeSponsor whereUpdatedAt($value)
 *
 * @property float $value
 *
 * @method static Builder|IncomeSponsor whereValue($value)
 *
 * @mixin Eloquent
 */
class IncomeSponsor extends Pivot
{
    use HasFactory, HasUuids;

    protected $table = 'income_sponsor';
}
