<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\AcademicLevel;
use App\Models\Event;
use App\Models\Orphan;
use App\Models\PrivateSchool;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/** @noinspection NullPointerExceptionInspection
 * @noinspection StaticClosureCanBeUsedInspection
 */
function getSchools(): LengthAwarePaginator
{
    return search(PrivateSchool::getModel())
        ->query(fn ($query) => $query->with('lessons'))
        ->paginate(perPage: request()->integer('perPage', 10));
}

function getLessons(): Collection
{
    return Event::select(['id', 'title', 'color'])
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

function formatedAcademicLevels(): array
{
    $formattedArray = [];

    foreach (AcademicLevel::all() as $row) {
        $formattedArray[$row['phase']]['phase'] = $row['phase'];

        $formattedArray[$row['phase']]['levels'][] = ['name' => $row['level'], 'id' => $row['id']];
    }

    return array_values($formattedArray);
}

function getSchoolsForAddLesson(): Collection
{
    return search(PrivateSchool::getModel())
        ->query(fn ($query) => $query
            ->withCount('lessons')
            ->with(['lessons:id,private_school_id,quota,academic_level_id', 'subjects']))->get();
}

function getOrphansForAddLesson(): \Illuminate\Database\Eloquent\Collection
{
    return search(Orphan::getModel(), 'AND academic_level.id = '.request()->input('academic_level_id'))->get();
}

function formatDateFromTo($dateFrom, $dateTo): string
{
    return Carbon::parse($dateFrom)->format('d M, g:i A').' - '.Carbon::parse($dateTo)->format('g:i A');
}
