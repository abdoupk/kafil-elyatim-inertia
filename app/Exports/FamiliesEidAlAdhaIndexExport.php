<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class FamiliesEidAlAdhaIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport();
    }
}
