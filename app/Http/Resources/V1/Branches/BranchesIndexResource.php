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
 * @property string $created_at
 */
class BranchesIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->whenLoaded('city', fn () => $this->city->getFullName()),
            'president' => $this->whenLoaded('president', fn () => [
                'id' => $this->president->id,
                'name' => $this->president->getName(),
            ]),
            'families_count' => $this->whenLoaded('families', fn () => $this->families->count()),
            'created_at' => Carbon::createFromTimeString($this->created_at)->format('Y-m-d'),
        ];
    }
}
