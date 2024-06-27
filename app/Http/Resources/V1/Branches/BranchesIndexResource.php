<?php

namespace App\Http\Resources\V1\Branches;

use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string name
 * @property User $president
 * @property City $city
 */
class BranchesIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->whenLoaded('city', fn () => $this->city->getFullName()),
            'president' => $this->whenLoaded('president', fn () => $this->president->getName()),
            'created_at' => Carbon::createFromTimeString($this->created_at)->format('Y-m-d'),
        ];
    }
}
