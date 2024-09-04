<?php

namespace App\Exports\FullExports;

use App\Models\Sponsor;
use Maatwebsite\Excel\Concerns\FromCollection;

class SponsorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sponsor::all();
    }
}
