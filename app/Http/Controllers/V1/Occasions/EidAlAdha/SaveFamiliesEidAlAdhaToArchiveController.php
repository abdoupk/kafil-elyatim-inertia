<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Http\Controllers\Controller;
use App\Models\FamilySponsorship;

class SaveFamiliesEidAlAdhaToArchiveController extends Controller
{
    public function __invoke()
    {
        listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport()->flatMap(function (FamilySponsorship $familySponsorShip) {
            saveToArchive('eid_al_adha', $familySponsorShip);
        });
    }
}
