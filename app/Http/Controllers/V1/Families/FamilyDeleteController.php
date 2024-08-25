<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Family\FamilyTrashedJob;
use App\Models\Family;

class FamilyDeleteController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->unsearchable();

        $family->delete();

        dispatch(new FamilyTrashedJob($family, auth()->user()));

        return redirect()->back();
    }
}
