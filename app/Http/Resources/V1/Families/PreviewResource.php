<?php

namespace App\Http\Resources\V1\Families;

use App\Http\Resources\V1\Members\MemberUpdateResource;
use App\Models\Preview;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Preview */
class PreviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'report' => $this->report,
            'preview_date' => $this->preview_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'inspectors_count' => $this->inspectors_count,

            'family_id' => $this->family_id,
            'tenant_id' => $this->tenant_id,

            'family' => new FamilyShowResource($this->whenLoaded('family')),
            'inspectors' => MemberUpdateResource::collection($this->whenLoaded('inspectors')),
            'family' => new FamilyShowResource($this->whenLoaded('family')),
        ];
    }
}
