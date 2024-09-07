<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OccasionsOrphansExport implements FromCollection, WithEvents, WithHeadings, WithMapping
{
    public function __construct(public string $occasion)
    {
    }

    public function collection(): Collection
    {
        return Archive::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(app()->getLocale() === 'ar');
            },
        ];
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
    }
}
