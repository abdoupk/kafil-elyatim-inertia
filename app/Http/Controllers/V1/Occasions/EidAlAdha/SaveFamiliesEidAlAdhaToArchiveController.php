<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Occasion\EidAlAdhaFamiliesListSavedJob;
use App\Models\Archive;
use App\Models\FamilySponsorship;

class SaveFamiliesEidAlAdhaToArchiveController extends Controller
{
    public function __invoke()
    {
        $archive = Archive::where('occasion', '=', 'eid_al_adha')
            ->whereYear('created_at', '=', now()->year)->firstOrCreate([
                'occasion' => 'eid_al_adha',
                'saved_by' => auth()->user()->id,
            ]);

        $archive->families()
            ->syncWithPivotValues(listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport()->map(function (FamilySponsorship $sponsorship) {
                return $sponsorship->family->id;
            }), ['tenant_id' => tenant('id')]);

        dispatch(new EidAlAdhaFamiliesListSavedJob($archive, auth()->user()));
    }
}
