<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $degree_of_kinship
 * @property string $phone_number
 * @property string $address
 * @property float $income
 * @property string $family_id
 * @property string $tenant_id
 * @property string|null $deleted_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @method static Builder|SecondSponsor newModelQuery()
 * @method static Builder|SecondSponsor newQuery()
 * @method static Builder|SecondSponsor query()
 * @method static Builder|SecondSponsor whereAddress($value)
 * @method static Builder|SecondSponsor whereCreatedAt($value)
 * @method static Builder|SecondSponsor whereDegreeOfKinship($value)
 * @method static Builder|SecondSponsor whereDeletedAt($value)
 * @method static Builder|SecondSponsor whereFamilyId($value)
 * @method static Builder|SecondSponsor whereFirstName($value)
 * @method static Builder|SecondSponsor whereId($value)
 * @method static Builder|SecondSponsor whereIncome($value)
 * @method static Builder|SecondSponsor whereLastName($value)
 * @method static Builder|SecondSponsor wherePhoneNumber($value)
 * @method static Builder|SecondSponsor whereTenantId($value)
 * @method static Builder|SecondSponsor whereUpdatedAt($value)
 * @method static \Database\Factories\SecondSponsorFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
class SecondSponsor extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;
}
