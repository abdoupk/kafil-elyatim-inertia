<?php

namespace App\Exports\FullExports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection(): Collection
    {
        return User::all();
    }
}
