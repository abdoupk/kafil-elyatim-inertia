<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;

class MonthlyBasketFamiliesExport implements FromCollection, WithEvents, WithMultipleSheets
{
    public function __construct(public int $year)
    {
    }

    public function collection(): Collection
    {
        return Archive::whereOccasion('monthly_basket')
            ->whereYear('created_at', $this->year)
            ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $event->sheet->getDelegate()->setRightToLeft(app()->getLocale() === 'ar');
            },
        ];
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new MonthlyBasketPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
