<?php

namespace App\Http\Resources\V1\Members;

use App\Http\Resources\V1\ZoneResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string first_name
 * @property string last_name
 * @property string $phone
 * @property string $email
 */
class MembersIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name.' '.$this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'zone' => ZoneResource::make($this->whenLoaded('zone')),
        ];
    }
}
