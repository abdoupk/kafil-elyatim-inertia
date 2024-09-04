<?php

namespace App\Exports\FullExports;

use App\Models\Orphan;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrphansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Orphan::all();
    }
}
