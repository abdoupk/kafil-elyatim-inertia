<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrphansIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect(getOrphans()->items());
    }
}
