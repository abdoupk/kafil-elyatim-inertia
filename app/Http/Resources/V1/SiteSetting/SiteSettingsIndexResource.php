<?php

namespace App\Http\Resources\V1\SiteSetting;

use App\Http\Resources\V1\Cities\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingsIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $city = City::whereId($this->city_id)->first();

        return [
            'association' => $this->association,
            'city' => CityResource::make($city),
            'city_id' => $this->city_id,
            'domain' => explode('.', $this->domain)[0],
            'super_admin' => [
                'id' => $this->super_admin['id'],
                'name' => $this->super_admin['name'],
            ],
            'address' => $this->address,
        ];
    }
}
