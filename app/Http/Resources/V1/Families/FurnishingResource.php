<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Furnishing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Furnishing */
class FurnishingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'families_count' => $this->families_count,
            'id' => $this->id,
            'name' => $this->name,
            'television' => $this->television,
            'refrigerator' => $this->refrigerator,
            'fireplace' => $this->fireplace,
            'washing_machine' => $this->washing_machine,
            'water_heater' => $this->water_heater,
            'oven' => $this->oven,
            'wardrobe' => $this->wardrobe,
            'cupboard' => $this->cupboard,
            'covers' => $this->covers,
            'mattresses' => $this->mattresses,
            'other_furnishings' => $this->other_furnishings,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'family_id' => $this->family_id,
            'tenant_id' => $this->tenant_id,

            'family' => new FamilyShowResource($this->whenLoaded('family')),
            'family' => new FamilyShowResource($this->whenLoaded('family')),
        ];
    }
}
