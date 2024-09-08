<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use App\Models\Orphan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SchoolEntryOrphansListExport implements WithEvents, FromCollection, WithHeadings
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $event->sheet->getDelegate()->setRightToLeft(app()->getLocale() === 'ar');
            },
        ];
    }

    public function collection(): Collection
    {
        return Archive::whereOccasion('school_entry')->get()->map(function (Archive $archive) {
            return $archive->listOrphans
                ->load(
                    'lastAcademicYearAchievement',
                    'academicLevel'
                )
                ->map(function (Orphan $orphan) {
                    return [
                        $orphan->sponsor->getName(),
                        $orphan->sponsor->formattedPhoneNumber(),
                        $orphan->getName(),
                        trans_choice(
                            'age_years',
                            $orphan->birth_date->age,
                            [
                                'count' => $orphan->birth_date->age,
                            ]
                        ),
                        __($orphan->gender),
                        $orphan->academicLevel?->level,
                        $orphan->lastAcademicYearAchievement?->average,
                    ];
                });
        });
    }

    public function headings(): array
    {
        return [
            trans('the_sponsor'),
            trans('sponsor_phone_number'),
            trans('first_and_last_name'),
            trans('age'),
            trans('filters.gender'),
            trans('academic_level'),
            trans('general_average'),
        ];
    }
}
