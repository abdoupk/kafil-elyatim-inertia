<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;

class FamilyDeleteController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->delete();

        $family->archives()->searchable();

        $family->sponsorships()->delete();

        $family->sponsorships()->searchable();

        $family->orphans()->delete();

        $family->orphans()->searchable();

        $family->babies()->delete();

        $family->babies()->searchable();

        $family->sponsor()->delete();

        $family->sponsor()->searchable();

        return redirect()->back();
    }
}
