<?php

namespace App\Http\Resources\V1\Lessons;

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
            'subjects' => $this->whenLoaded('subjects')->map(fn ($lesson) => [
                'id' => $lesson->subject->id ?? $this->id,
                'name' => $lesson->subject->getName(),
                'quota' => $lesson->quota,
            ]),
        ];
    }
}
