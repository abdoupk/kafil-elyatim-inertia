<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Occasion\EidSuitOrphansListSavedJob;
use App\Models\Archive;
use App\Models\OrphanSponsorship;

class SaveOrphansEidSuitToArchiveController extends Controller
{
    public function __invoke()
    {
        $archive = Archive::where('occasion', '=', 'eid_suit')
            ->whereMonth('created_at', '=', now()->month)->firstOrCreate([
                'occasion' => 'eid_suit',
                'saved_by' => auth()->user()->id,
            ]);

        $archive->orphans()
            ->syncWithPivotValues(listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport()->map(function (OrphanSponsorship $sponsorship) {
                return $sponsorship->orphan->id;
            }), ['tenant_id' => tenant('id')]);

        dispatch(new EidSuitOrphansListSavedJob($archive, auth()->user()));
    }
}
