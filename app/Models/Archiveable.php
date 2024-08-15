<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Archiveable extends Pivot
{
    protected $table = 'archiveables';
}
