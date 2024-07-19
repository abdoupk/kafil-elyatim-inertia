<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\PrivateSchool;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/** @noinspection NullPointerExceptionInspection
 * @noinspection StaticClosureCanBeUsedInspection
 */
function getSchools(): LengthAwarePaginator
{
    return search(PrivateSchool::getModel())
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()->input('perPage', 10));
}

function getLessons(): Collection
{
    return \App\Models\Event::select(['id', 'title', 'color'])
        ->with(['occurrences' => function ($query) {
            $query->select('id', 'event_id', 'start_date', 'end_date');
        }])
        ->get()
        ->map(function ($event) {
            return $event->occurrences->map(function ($occurrence) use ($event) {
                return [
                    'id' => $occurrence->id,
                    'title' => $event->title,
                    'color' => $event->color,
                    'start' => $occurrence->start_date,
                    'end' => $occurrence->end_date,
                    //                    'url' => route('tenant.lessons.details-lesson', $occurrence->id),
                ];
            });
        })->flatten(1);
}
