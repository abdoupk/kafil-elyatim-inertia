<?php

namespace App\Http\Requests\V1\Lessons;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

/* @mixin Event */
class LessonCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            //            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'color' => 'required|hex_color',
            'until' => 'nullable|date',
            'orphans.*.id' => 'required|exists:orphans,id',
            'school.id' => 'required|exists:App\Models\PrivateSchool,id',
            'subject.id' => 'required',
            'frequency' => 'nullable|in:weekly,monthly,daily|required_with:interval',
            'interval' => 'nullable|integer|min:1|required_with:frequency',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
