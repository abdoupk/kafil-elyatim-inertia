<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Family */
class FamilyEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'file_number' => $this->file_number,
            'start_date' => $this->start_date,

            'branch_id' => $this->branch_id,
            'zone_id' => $this->zone_id,

            'spouse' => new SpouseResource($this->whenLoaded('deceased')),

            'second_sponsor' => new SecondSponsorResource($this->whenLoaded('secondSponsor')),

            'furnishings' => new FurnishingResource($this->whenLoaded('furnishings')),

            'housing' => new FamilyEditHousingResource($this->whenLoaded('housing')),

            'family_sponsorships' => new FamilySponsorshipResource($this->whenLoaded('sponsorships')),

            'preview' => new PreviewResource($this->whenLoaded('preview')),
        ];
    }
}
