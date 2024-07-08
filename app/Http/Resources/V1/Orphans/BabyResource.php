<?php

namespace App\Http\Resources\V1\Orphans;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Baby */
class BabyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'baby_milk_quantity' => $this->baby_milk_quantity,
            'baby_milk_type' => $this->baby_milk_type,
            'diapers_quantity' => $this->diapers_quantity,
            'diapers_type' => $this->diapers_type,
        ];
    }
}
