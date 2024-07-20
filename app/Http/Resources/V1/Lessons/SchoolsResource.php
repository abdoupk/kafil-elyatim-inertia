<?php

namespace App\Http\Resources\V1\Lessons;

use App\Models\Lesson;
use App\Models\PrivateSchool;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PrivateSchool */
class SchoolsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lessons_count' => $this->lessons_count,
            'quota' => $this->lessons->sum('quota'),
            'subjects' => $this->whenLoaded('subjects')->map(fn (Lesson $lesson) => [
                'id' => $lesson->subject->id ?? $this->id,
                'name' => $lesson->subject->getName().' - '.$lesson->academicLevel?->level,
                'quota' => $lesson->quota - $lesson->orphans->count(),
                'academic_level_id' => $lesson->academic_level_id,
            ]),
        ];
    }
}
