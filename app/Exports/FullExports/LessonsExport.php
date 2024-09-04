<?php

namespace App\Exports\FullExports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;

class LessonsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Event::all();
    }
}
