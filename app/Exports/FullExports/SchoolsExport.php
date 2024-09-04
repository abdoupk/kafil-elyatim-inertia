<?php

namespace App\Exports\FullExports;

use App\Models\PrivateSchool;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchoolsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PrivateSchool::all();
    }
}
