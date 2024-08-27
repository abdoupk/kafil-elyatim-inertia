<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Family\FamilyRestoredJob;
use App\Models\Family;

class FamilyRestoreController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->restore();

        $family->searchable();

        dispatch(new FamilyRestoredJob($family, auth()->user()));

        return redirect()->back();
    }
}
