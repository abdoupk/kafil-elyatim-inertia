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
            __('the_sponsor'),
            __('sponsor_phone_number'),
            __('validation.attributes.address'),
            __('orphans_count'),
            __('incomes.label.total_income'),
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

        return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport()->map(function (FamilySponsorship $familySponsorship, $key) {
            return [
                $key + 1,
                $familySponsorship->family->sponsor->getName(),
                $familySponsorship->family->sponsor->formattedPhoneNumber(),
                $familySponsorship->family->address,
                $familySponsorship->family->loadCount('orphans')->orphans_count,
                formatCurrency($familySponsorship->family->totalIncomes()),
            ];
        });
    }
}
