<?php

namespace App\Http\Resources\V1\Families;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Sponsor */
class SponsorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_number' => $this->file_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'sponsorship_type' => $this->sponsorship_type,
            'birth_date' => $this->birth_date,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'birth_certificate' => $this->birth_certificate,
            'academic_level' => $this->academic_level,
            'function' => $this->function,
            'health_status' => $this->health_status,
            'diploma' => $this->diploma,
            'ccp' => $this->ccp,
            'gender' => $this->gender,
            'created_by' => $this->created_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'number' => $this->number,
            'name' => $this->name,
            'birth_certificate_number' => $this->birth_certificate_number,
            'card_number' => $this->card_number,
            'sponsor_type' => $this->sponsor_type,
            'incomes' => $this->whenLoaded('incomes'),
        ];
    }
}
