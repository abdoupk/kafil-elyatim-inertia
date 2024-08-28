<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Models\Orphan;

class OrphanRestoreController extends Controller
{
    public function __invoke(Orphan $orphan)
    {
        $orphan->restoreWithRelations();

        return redirect()->back();
    }
}
