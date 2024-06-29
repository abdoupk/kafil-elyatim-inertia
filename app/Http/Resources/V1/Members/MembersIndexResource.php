<?php

namespace App\Http\Resources\V1\Members;

use App\Http\Resources\V1\Zones\ZoneResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $phone
 * @property string $email
 *
 * @method string getName()
 */
class MembersIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'email' => $this->email,
            'phone' => $this->phone,
            'zone' => ZoneResource::make($this->whenLoaded('zone')),
        ];
    }
}
