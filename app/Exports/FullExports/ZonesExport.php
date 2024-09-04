<?php

namespace App\Exports\FullExports;

use App\Models\Zone;
use Maatwebsite\Excel\Concerns\FromCollection;

class ZonesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Zone::all();
    }
}
