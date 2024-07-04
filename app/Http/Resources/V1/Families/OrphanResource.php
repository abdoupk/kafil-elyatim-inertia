<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Orphan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Orphan */
class OrphanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'family_status' => $this->family_status,
            'health_status' => $this->health_status,
            'academic_level' => $this->academic_level,
            'shoes_size' => $this->shoes_size,
            'pants_size' => $this->pants_size,
            'shirt_size' => $this->shirt_size,
            'note' => $this->note,
            'gender' => $this->gender,
        ];
    }
}
