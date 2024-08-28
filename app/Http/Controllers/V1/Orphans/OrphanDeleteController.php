<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Orphan\OrphanTrashedJob;
use App\Models\Orphan;

class OrphanDeleteController extends Controller
{
    public function __invoke(Orphan $orphan)
    {
        $orphan->deleteWithRelations();

        dispatch(new OrphanTrashedJob($orphan, auth()->user()));

        return redirect()->back();
    }
}
