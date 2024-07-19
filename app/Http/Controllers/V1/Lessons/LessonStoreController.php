<?php

namespace App\Http\Controllers\V1\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Lessons\LessonCreateRequest;
use App\Models\Event;
use App\Models\EventOccurrence;
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
        $event = Event::create([
            ...$request->except(['orphans', 'description']),
        ]);

        $this->generateOccurrences($event);

        $event->orphans()->sync($request->orphans);
    }

    /**
     * @throws InvalidWeekday
     * @throws InvalidArgument
     */
    private function generateOccurrences(Event $event)
    {
        if (! $event->interval || ! $event->frequency) {
            $event->occurrences()->create([
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'tenant_id' => $event->tenant_id,
            ]);

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
        $occurrence_data = [];

        foreach ($occurrences as $occurrence) {
            $occurrence_data[] = [
                'id' => Str::uuid()->toString(),
                'event_id' => $event->id,
                'start_date' => $occurrence->getStart(),
                'end_date' => $occurrence->getEnd(),
                'tenant_id' => $event->tenant_id,
            ];
        }

        EventOccurrence::insert($occurrence_data);
    }
}
