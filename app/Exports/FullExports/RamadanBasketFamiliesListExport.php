<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use App\Models\Family;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class RamadanBasketFamiliesListExport implements WithEvents, FromCollection, WithHeadings
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
        return Archive::whereOccasion('ramadan_basket')->get()->map(function (Archive $archive) {
            return $archive->listFamilies
                ->map(function (Family $family) {
                    return [
                        $family->sponsor->getName(),
                        $family->sponsor->formattedPhoneNumber(),
                        $family->address,
                        $family->zone->name,
                        $family->branch->name,
                        formatCurrency($family->total_income ?? 0),
                        $family->income_rate,
                    ];
                });
        });
    }

    public function headings(): array
    {
        return [
            trans('the_sponsor'),
            trans('sponsor_phone_number'),
            trans('validation.attributes.address'),
            trans('the_zone'),
            trans('the_branch'),
            trans('incomes.label.total_income'),
            trans('income_rate'),
        ];
    }
}
