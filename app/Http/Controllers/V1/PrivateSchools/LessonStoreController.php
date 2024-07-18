<?php

namespace App\Http\Controllers\V1\PrivateSchools;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\LessonCreateRequest;
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
            'school_id' => $request->school['id'],
            'subject_id' => $request->subject['id'],
            ...$request->except(['school', 'subject', 'orphans', 'description']),
        ]);

        $this->generateOccurrences($event);
    }

    /**
     * @throws InvalidWeekday
     * @throws InvalidArgument
     */
    private function generateOccurrences(Event $event)
    {
        //        $startDate = $event->start_date;
        //        $endDate = $event->end_date;
        //        $frequency = $event->frequency;
        //        $interval = $event->interval;
        //        $until = $event->until;
        //
        //        $occurrences = [];
        //
        //        while ($startDate <= $endDate) {
        //            if ($frequency == 'daily') {
        //                $occurrenceDate = $startDate;
        //                $startDate = $startDate->addDays($interval);
        //            } elseif ($frequency == 'weekly') {
        //                $occurrenceDate = $startDate;
        //                $startDate = $startDate->addWeeks($interval);
        //            } elseif ($frequency == 'monthly') {
        //                $occurrenceDate = $startDate;
        //                $startDate = $startDate->addMonths($interval);
        //            }
        //
        //            if ($until && $occurrenceDate > $until) {
        //                break;
        //            }
        //
        //            $occurrences[] = [
        //                'id' => Str::uuid()->toString(),
        //                'event_id' => $event->id,
        //                'date' => $occurrenceDate,
        //                'tenant_id' => $event->tenant_id,
        //            ];
        //        }
        //
        //        EventOccurrence::insert($occurrences);
        $rule = new Rule;
        $rule->setStartDate($event->start_date);
        $rule->setEndDate($event->end_date);
        $rule->setFreq(Str::upper($event->frequency));
        $rule->setInterval($event->interval);
        $rule->setUntil(Carbon::parse($event->until));

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
