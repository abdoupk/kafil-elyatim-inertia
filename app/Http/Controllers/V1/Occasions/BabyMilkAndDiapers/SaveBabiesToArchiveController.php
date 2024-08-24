<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Occasion\BabiesMilkAndDiapersListSavedJob;
use App\Models\Archive;
use App\Models\Baby;
use DB;
use Throwable;

class SaveBabiesToArchiveController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke()
    {
        DB::transaction(function () {
            $archive = $this->getOrCreateArchive();

            $this->restoreQuantities($archive);

            $this->syncBabiesWithArchive($archive);

            $this->decrementQuantities($archive);

            $this->dispatchJob($archive);
        });
    }

    private function getOrCreateArchive()
    {
        return Archive::query()
            ->where('occasion', 'babies_milk_and_diapers')
            ->whereMonth('created_at', now()->month)
            ->first() ?? Archive::create([
                'occasion' => 'babies_milk_and_diapers',
                'saved_by' => auth()->user()->id,
            ]);
    }

    private function restoreQuantities(Archive $archive)
    {
        $archive->listBabies()
            ->with(['diapers', 'babyMilk'])
            ->each(function (Baby $baby) {
                $baby->diapers()->update(['qty' => $baby->diapers->qty + $baby->diapers_quantity]);

                $baby->babyMilk()->update(['qty' => $baby->babyMilk->qty + $baby->baby_milk_quantity]);
            });
    }

    private function syncBabiesWithArchive(Archive $archive)
    {
        $archive->babies()
            ->syncWithPivotValues(
                getBabiesForExport()->pluck('id'),
                ['tenant_id' => tenant('id')]
            );
    }

    private function decrementQuantities(Archive $archive)
    {
        $archive->listBabies()
            ->with(['diapers', 'babyMilk'])
            ->each(function (Baby $baby) {
                $baby->diapers()->update(['qty' => $baby->diapers->qty - $baby->diapers_quantity]);

                $baby->babyMilk()->update(['qty' => $baby->babyMilk->qty - $baby->baby_milk_quantity]);
            });
    }

    private function dispatchJob(Archive $archive)
    {
        dispatch(new BabiesMilkAndDiapersListSavedJob($archive, auth()->user()));
    }
}
