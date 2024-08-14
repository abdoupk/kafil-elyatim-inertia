<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Models\Archive;

class SaveBabiesToArchiveController extends Controller
{
    public function __invoke()
    {
        Archive::where('occasion', '=', 'babies_milk_and_diapers')
            ->whereMonth('created_at', '=', now()->month)->firstOrCreate([
                'occasion' => 'babies_milk_and_diapers',
                'saved_by' => auth()->user()->id,
            ])
            ->babies()
            ->syncWithPivotValues(getBabiesForExport()->pluck('id'), ['tenant_id' => tenant('id')]);
    }
}
