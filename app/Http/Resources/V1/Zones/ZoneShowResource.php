<?php

namespace App\Http\Resources\V1\Zones;

use App\Http\Resources\V1\Families\FamilyShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Zone */
class ZoneShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'deleted_by' => $this->deleted_by,
            'families_count' => $this->families_count,

            'tenant_id' => $this->tenant_id,

            'families' => FamilyShowResource::collection($this->whenLoaded('families')),
        ];
    }
}
