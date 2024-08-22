<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Family\FamilyTrashedJob;
use App\Models\Family;
use App\Models\Orphan;

class FamilyDeleteController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->unsearchable();

        $family->orphans()->each(function (Orphan $orphan) {
            $orphan->babyNeeds()->unsearchable();

            $orphan->babyNeeds()->delete();

            $orphan->sponsorships()->unsearchable();

            $orphan->needs()->unsearchable();

            $orphan->needs()->delete();

            $orphan->unsearchable();
        });

        $family->sponsor->sponsorships()->unsearchable();

        $family->sponsor->needs()->unsearchable();

        $family->sponsor()->unsearchable();

        $family->sponsor()->delete();

        $family->delete();

        dispatch(new FamilyTrashedJob($family, auth()->user()));

        return redirect()->back();
    }
}
