<?php

namespace App\Http\Resources\V1\Families;

use App\Http\Resources\V1\Orphans\OrphansIndexResource;
use App\Http\Resources\V1\SponsorsIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Family */
class FamilyShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'report' => $this->report,
            'address' => $this->address,
            'file_number' => $this->file_number,
            'start_date' => $this->start_date,
            'branch_id' => $this->branch_id,

            'zone_id' => $this->zone_id,

            'orphans' => OrphansIndexResource::collection($this->whenLoaded('orphans')),
            'sponsor' => new SponsorsIndexResource($this->whenLoaded('sponsor')),
        ];
    }
}
