<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use App\Models\Orphan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class EidSuitOrphansListExport implements WithEvents, FromCollection, WithHeadings
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
        return Archive::whereOccasion('eid_suit')->get()->map(function (Archive $archive) {
            return $archive->listOrphans
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
                        $orphan->shoesSize?->label,
                        $orphan->pantsSize?->label,
                        $orphan->shirtSize?->label,
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
            trans('shoes_size'),
            trans('pants_size'),
            trans('shirt_size'),
        ];
    }
}
