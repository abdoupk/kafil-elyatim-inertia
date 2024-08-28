<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Family\FamilyTrashedJob;
use App\Models\Family;
use DB;
use Throwable;

class FamilyDeleteController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Family $family)
    {
        DB::transaction(function () use ($family) {
            $family->unSearchWithRelations();

            $family->deleteWithRelationships();
        });

        dispatch(new FamilyTrashedJob($family, auth()->user()));

        return redirect()->back();
    }
}
