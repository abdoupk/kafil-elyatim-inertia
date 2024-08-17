<?php

namespace App\Http\Resources\V1\Schools;

use App\Http\Resources\V1\Events\LessonResource;
use App\Models\PrivateSchool;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PrivateSchool */
class SchoolShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'lessons_count' => $this->lessons_count,
            'created_by' => $this->created_by,
            'deleted_by' => $this->deleted_by,
            'subjects_count' => $this->subjects_count,

            'tenant_id' => $this->tenant_id,

            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
            'subjects' => LessonResource::collection($this->whenLoaded('subjects')),
        ];
    }
}
