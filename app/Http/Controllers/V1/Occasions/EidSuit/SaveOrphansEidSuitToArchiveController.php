<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;

class SaveOrphansEidSuitToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('eid_suit', function () {
            return listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport();
        });
    }
}
