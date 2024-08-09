<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class FamiliesRamadanBasketIndexExport implements FromCollection
{
    public function collection(): Collection
    {
        return listOfFamiliesBenefitingFromTheRamadanBasketSponsorshipForExport();
    }
}
