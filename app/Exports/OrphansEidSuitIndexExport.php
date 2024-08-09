<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrphansEidSuitIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport();
    }
}
