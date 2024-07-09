<?php

namespace App\Http\Resources\V1\Needs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Need */
class NeedsIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'demand' => $this->demand,
            'subject' => $this->subject,
            'status' => $this->status,
            'needable' => [
                'id' => $this->needable_id,
                'name' => $this->needable->getName(),
                'type' => $this->needable_type,
            ],
            'note' => $this->note,
        ];
    }
}
