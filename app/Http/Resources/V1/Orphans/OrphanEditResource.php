<?php

namespace App\Http\Resources\V1\Orphans;

use App\Http\Resources\AcademicAchievementResource;
use App\Http\Resources\V1\Members\MemberResource;
use App\Models\Orphan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Orphan */
class OrphanEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $babyNeeds = now()->diff($this->birth_date)->y < 2
            ? $this->babyNeeds->only(['baby_milk_quantity', 'baby_milk_type', 'diapers_quantity', 'diapers_type'])
            : ['baby_milk_quantity' => null, 'baby_milk_type' => null, 'diapers_quantity' => null, 'diapers_type' => null];

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'creator' => new MemberResource($this->whenLoaded('creator')),
            'birth_date' => $this->birth_date,
            'family_status' => $this->family_status,
            'health_status' => $this->health_status,
            'academic_level' => $this->academicLevel?->level,
            'last_academic_year_achievement' => $this->formatedLastAcademicYear(),
            ...$babyNeeds,
            'shoes_size' => $this->whenLoaded('shoesSize'),
            'pants_size' => $this->whenLoaded('pantsSize'),
            'shirt_size' => $this->whenLoaded('shirtSize'),
            'gender' => $this->gender,
            'note' => $this->note,

            'academic_achievements' => AcademicAchievementResource::collection($this->whenLoaded('academicAchievements')),
            'sponsorships' => new OrphanSponsorshipResource($this->whenLoaded('sponsorships')),
            'vocational_training_achievements' => VocationalTrainingAchievementResource::collection($this->whenLoaded('vocationalTrainingAchievements')),
            'college_achievements' => CollegeAchievementResource::collection($this->whenLoaded('collegeAchievements')),
        ];
    }
}
