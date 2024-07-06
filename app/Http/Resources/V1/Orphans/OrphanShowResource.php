<?php

namespace App\Http\Resources\V1\Orphans;

use App\Http\Resources\AcademicAchievementResource;
use App\Http\Resources\V1\Members\MemberResource;
use App\Models\Orphan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Orphan */
class OrphanShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'birth_date' => $this->birth_date,
            'family_status' => $this->family_status,
            'health_status' => $this->health_status,
            'academic_level' => $this->academic_level,
            'shoes_size' => $this->shoes_size,
            'pants_size' => $this->pants_size,
            'shirt_size' => $this->shirt_size,
            '' => $this->whenLoaded('ba'),
            'note' => $this->note,
            'creator' => new MemberResource($this->whenLoaded('creator')),
            'gender' => $this->gender,

            'academicAchievements' => AcademicAchievementResource::collection($this->whenLoaded('academicAchievements')),

            'sponsorships' => new OrphanSponsorshipResource($this->whenLoaded('sponsorships')),
        ];
    }
}
