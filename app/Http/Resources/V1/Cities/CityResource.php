<?php

namespace App\Http\Resources\V1\Cities;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin City */
class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'commune_name' => $this->commune_name,
            'daira_name' => $this->daira_name,
            'wilaya_code' => $this->wilaya_code,
            'wilaya_name' => $this->wilaya_name,
        ];
    }
}
