<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonCreateRequest;
use App\Jobs\V1\Lesson\LessonCreatedJob;
use App\Models\Event;
use App\Models\EventOccurrence;
use App\Models\Lesson;
use Carbon\Carbon;
use Recurr\Exception\InvalidArgument;
use Recurr\Exception\InvalidWeekday;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Str;

class LessonStoreController extends Controller
{
    /**
     * @throws InvalidWeekday
     * @throws InvalidArgument
     */
    public function __invoke(LessonCreateRequest $request)
    {
        $lesson = Lesson::where('subject_id', $request->subject_id)
            ->where('private_school_id', $request->school_id)
            ->where('academic_level_id', $request->academic_level_id)
            ->first();

        $event = Event::create([
            ...$request->except(['orphans', 'subject_id', 'academic_level_id', 'school_id']),
            'lesson_id' => $lesson->id,
        ]);

        dispatch(new LessonCreatedJob($event, auth()->user()));

        $this->generateOccurrences($event, $lesson->id, $request->orphans);
    }

    /**
     * @throws InvalidWeekday
     * @throws InvalidArgument
     */
    private function generateOccurrences(Event $event, string $lesson_id, array $orphans)
    {
        $formatted = array_map(function ($orphan) use ($lesson_id) {
            return [
                'orphan_id' => $orphan,
                'lesson_id' => $lesson_id,
            ];
        }, $orphans);

        if (! $event->interval || ! $event->frequency) {
            $event_occurrence = $event->occurrences()->create([
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'tenant_id' => $event->tenant_id,
                'lesson_id' => $lesson_id,
            ]);

            $event_occurrence->orphans()->syncWithoutDetaching($formatted);

            return;
        }

        $frequency = $event->frequency;
        $interval = $event->interval;

        if ($event->frequency === 'weekly') {
            $frequency = 'daily';
            $interval = 7 * $event->interval;
        }

        $rule = new Rule;
        $rule->setStartDate($event->start_date);
        $rule->setEndDate($event->end_date);
        $rule->setFreq(Str::upper($frequency));
        $rule->setInterval($interval);
        $rule->setUntil(Carbon::parse($event->until));
        $rule->setWeekStart('SU');

        $transformer = new ArrayTransformer;
        $occurrences = $transformer->transform($rule);

        foreach ($occurrences as $occurrence) {
            $event_occurrence = EventOccurrence::create([
                'id' => Str::uuid()->toString(),
                'event_id' => $event->id,
                'lesson_id' => $lesson_id,
                'start_date' => $occurrence->getStart(),
                'end_date' => $occurrence->getEnd(),
                'tenant_id' => $event->tenant_id,
            ]);

            $event_occurrence->orphans()->syncWithoutDetaching($formatted);
        }
    }
}
