<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class FamiliesIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect(getFamilies()->items());
    }
}
