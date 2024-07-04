<?php

namespace App\Http\Resources\V1\Families;

use App\Http\Resources\V1\Orphans\OrphansIndexResource;
use App\Models\OrphanSponsorship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrphanSponsorship */
class OrphanSponsorshipResource extends JsonResource
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
            'university_scholarship' => $this->university_scholarship,
            'association_trips' => $this->association_trips,
            'summer_camp' => $this->summer_camp,
            'eid_suit' => $this->eid_suit,
            'private_lessons' => $this->private_lessons,
            'school_bag' => $this->school_bag,

            'orphan_id' => $this->orphan_id,
            'tenant_id' => $this->tenant_id,

            'orphan' => new OrphansIndexResource($this->whenLoaded('orphan')),
            'orphan' => new OrphansIndexResource($this->whenLoaded('orphan')),
        ];
    }
}
