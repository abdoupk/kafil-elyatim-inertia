<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string name
 * @property Carbon start_date
 * @property Zone zone
 * @property int file_number
 * @property string $address
 */
class FamiliesIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'zone' => $this->zone->name,
            'start_date' => $this->start_date,
            'file_number' => $this->file_number,
        ];
    }
}
