<?php

namespace App\Http\Resources\V1\Needs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Need */
class NeedUpdateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'demand' => $this->demand,
            'subject' => $this->subject,
            'note' => $this->note,
            'status' => $this->status,
        ];
    }
}
