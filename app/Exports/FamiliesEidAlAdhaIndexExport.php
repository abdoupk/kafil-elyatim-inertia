<?php

namespace App\Exports;

use App\Models\FamilySponsorship;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class FamiliesEidAlAdhaIndexExport implements FromCollection, WithEvents, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            __('update'),
            __('validation.attributes.created_at'),
            __('filters.baby_milk_quantity'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(app()->getLocale() == 'ar');
            },
        ];
    }

    public function collection(): Collection
    {

        return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport()->map(function (FamilySponsorship $familySponsorship) {
            return $familySponsorship->family;
        });
    }
}
