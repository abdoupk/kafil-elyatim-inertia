<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Http\Controllers\Controller;
use App\Models\Archive;

class SaveFamiliesEidAlAdhaToArchiveController extends Controller
{
    public function __invoke()
    {
        Archive::where('occasion', '=', 'eid_al_adha')
            ->whereYear('created_at', '=', now()->year)->firstOrCreate([
                'occasion' => 'eid_al_adha',
                'saved_by' => auth()->user()->id,
            ])
            ->families()
            ->syncWithPivotValues(listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport()->pluck('id'), ['tenant_id' => tenant('id')]);
    }
}
