<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use DB;

class FamilyForceDeleteController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Family $family)
    {
        DB::transaction(function () use ($family) {
            $family->unSearchWithRelations();

            $family->forceDeleteWithRelationships();
        });

        return redirect()->back();
    }
}
