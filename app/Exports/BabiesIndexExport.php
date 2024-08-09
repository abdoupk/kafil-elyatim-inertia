<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class BabiesIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect(getBabiesForExport());
    }
}
