<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BabiesMilkAndDiapersListExport implements FromCollection, WithEvents, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Archive::where('occasion', 'babies_milk_and_diapers')->get();
    }

    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
    }

    public function headings(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(app()->getLocale() === 'ar');
            },
        ];
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
    }
}
