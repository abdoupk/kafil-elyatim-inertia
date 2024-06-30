<?php

namespace App\Http\Resources\V1;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Sponsor */
class SponsorsIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
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
            'sponsorships_count' => $this->sponsorships_count,
            'number' => $this->number,
            'birth_certificate_number' => $this->birth_certificate_number,
            'card_number' => $this->card_number,
            'incomes_count' => $this->incomes_count,
            'sponsor_type' => $this->sponsor_type,
        ];
    }
}
