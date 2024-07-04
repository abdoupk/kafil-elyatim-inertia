<?php

namespace App\Http\Resources\V1\Families;

use App\Http\Resources\V1\SponsorsIndexResource;
use App\Models\SponsorSponsorship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SponsorSponsorship */
class SponsorSponsorshipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sponsorship_id' => $this->sponsorship_id,
            'type' => $this->type,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'medical_sponsorship' => $this->medical_sponsorship,
            'literacy_lessons' => $this->literacy_lessons,
            'direct_sponsorship' => $this->direct_sponsorship,
            'project_support' => $this->project_support,

            'sponsor_id' => $this->sponsor_id,
            'tenant_id' => $this->tenant_id,

            'sponsor' => new SponsorsIndexResource($this->whenLoaded('sponsor')),
            'sponsor' => new SponsorsIndexResource($this->whenLoaded('sponsor')),
        ];
    }
}
