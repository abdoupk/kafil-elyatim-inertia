<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Orphan;

class FamilyRestoreController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->restore();

        $family->searchable();

        $family->sponsor()->withTrashed()->restore();

        $family->sponsor()->searchable();

        $sponsor = $family->load('sponsor')->sponsor;

        $sponsor->sponsorships()->searchable();

        $sponsor->needs()->withTrashed()->restore();

        $sponsor->needs()->searchable();

        $orphans = $family->orphans()->withTrashed();

        $orphans->each(function (Orphan $orphan) {
            $orphan->restore();

            $orphan->searchable();

            $orphan->babyNeeds()->restore();

            $orphan->babyNeeds()->searchable();

            $orphan->sponsorships()->searchable();

            $orphan->needs()->restore();

            $orphan->needs()->searchable();
        });

        return redirect()->back();
    }
}
