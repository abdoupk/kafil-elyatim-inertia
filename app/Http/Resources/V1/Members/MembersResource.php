<?php

namespace App\Http\Resources\V1\Members;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $last_name
 * @property string $first_name
 */
class MembersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name.' '.$this->last_name,
        ];
    }
}
