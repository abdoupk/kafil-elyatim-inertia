<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory;

    public static function booted(): void
    {
        static::created(function ($tenant) {
            $password = bcrypt($tenant->infos['super_admin']['password']);
            $tenant->update([
                'infos' => array_merge($tenant->infos, [
                    'super_admin' => array_merge($tenant->infos['super_admin'], ['password' => $password]),
                ]),
            ]);
        });

        static::creating(function ($tenant) {
            $tenant->calculation = json_encode(CALCULATION);
        });
    }

    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function schools(): HasMany
    {
        return $this->hasMany(PrivateSchool::class);
    }
}
