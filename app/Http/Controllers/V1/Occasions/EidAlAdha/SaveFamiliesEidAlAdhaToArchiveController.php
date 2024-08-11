<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Http\Controllers\Controller;

class SaveFamiliesEidAlAdhaToArchiveController extends Controller
{
    public function __invoke()
    {
        saveToArchive('eid_al_adha', function () {
            return listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport();
        });
    }
}
