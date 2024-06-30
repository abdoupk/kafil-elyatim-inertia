<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SponsorsIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect(getSponsors()->items());
    }
}
