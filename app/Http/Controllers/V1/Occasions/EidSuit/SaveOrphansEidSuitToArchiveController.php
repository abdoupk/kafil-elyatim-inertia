<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use App\Models\OrphanSponsorship;

class SaveOrphansEidSuitToArchiveController extends Controller
{
    public function __invoke()
    {
        listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport()->flatMap(function (OrphanSponsorship $orphanSponsorship) {
            saveToArchive('eid_suit', $orphanSponsorship);
        });
    }
}
