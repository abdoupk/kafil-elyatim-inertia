<?php

namespace App\Http\Resources\V1\Archive;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @mixin Family */
class MonthlyBasketArchiveIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'zone' => [
                'id' => $this->zone->id,
                'name' => $this->zone->name,
            ],
            'branch' => [
                'id' => $this->branch->id,
                'name' => $this->branch->name,
            ],
            'sponsor' => [
                'id' => $this->sponsor->id,
                'name' => $this->sponsor->getName(),
                'phone_number' => $this->sponsor->formattedPhoneNumber(),
            ],
            'orphans_count' => $this->orphans->count(),
            'total_income' => $this->totalIncomes(),
        ];
    }
}
