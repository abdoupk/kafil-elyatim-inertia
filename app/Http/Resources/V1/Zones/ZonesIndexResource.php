<?php

namespace App\Http\Resources\V1\Zones;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $created_at
 * @property string $name
 * @property string $id
 * @property string $description
 */
class ZonesIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => Carbon::createFromTimeString($this->created_at)->diffForHumans(),
        ];
    }
}
