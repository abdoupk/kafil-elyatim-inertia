<?php

namespace App\Http\Resources\V1\Families;

use App\Models\SecondSponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SecondSponsor */
class SecondSponsorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'degree_of_kinship' => $this->degree_of_kinship,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'income' => $this->income,
            'family_id' => $this->family_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'tenant_id' => $this->tenant_id,
        ];
    }
}
