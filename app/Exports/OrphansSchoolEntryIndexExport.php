<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrphansSchoolEntryIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect(listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship()->items());
    }
}
