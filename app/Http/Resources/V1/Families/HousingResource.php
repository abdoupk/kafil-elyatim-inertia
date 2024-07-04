<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Housing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Housing */
class HousingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value,
            'housing_receipt_number' => $this->housing_receipt_number,
            'number_of_rooms' => $this->number_of_rooms,
            'other_properties' => $this->other_properties,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'family_id' => $this->family_id,
            'tenant_id' => $this->tenant_id,

            'family' => new FamilyShowResource($this->whenLoaded('family')),
            'family' => new FamilyShowResource($this->whenLoaded('family')),
        ];
    }
}
