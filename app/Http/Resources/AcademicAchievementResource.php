<?php

namespace App\Http\Resources;

use App\Models\AcademicAchievement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AcademicAchievement */
class AcademicAchievementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'orphan_id' => $this->orphan_id,
            'academic_level' => $this->academic_level,
            'first_trimester' => $this->first_trimester,
            'second_trimester' => $this->second_trimester,
            'third_trimester' => $this->third_trimester,
            'average' => $this->average,
        ];
    }
}
