<?php

namespace App\Http\Controllers\V1\Occasions\MonthlyBasket;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Occasion\MonthlyBasketFamiliesListSavedJob;
use App\Models\Archive;
use App\Models\FamilySponsorship;
use App\Models\Inventory;
use DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Throwable;

class SaveFamiliesMonthlyBasketToArchiveController extends Controller implements HasMiddleware
{
    /**
     * @throws Throwable
     */
    public function __invoke()
    {
        DB::transaction(function () {
            $archive = $this->getOrCreateArchive();

            $this->restoreQuantities($archive);

            $this->syncFamiliesWithArchive($archive);

            $this->decrementQuantities($archive);

            $this->dispatchJob($archive);
        });
    }

    public static function middleware()
    {
        return ['can:save_occasions'];
    }

    private function getOrCreateArchive()
    {
        return Archive::query()
            ->where('occasion', 'monthly_basket')
            ->whereMonth('created_at', now()->month)
            ->first() ?? Archive::create([
                'occasion' => 'monthly_basket',
                'saved_by' => auth()->user()->id,
            ]);
    }

    private function restoreQuantities(Archive $archive)
    {
        $families_count = $archive->listFamilies()->count();

        Inventory::whereNotNull('qty_for_family')->where('type', '!=', 'baby_milk')
            ->where('type', '!=', 'diapers')->update([
                'qty' => Inventory::raw("qty + (qty_for_family * {$families_count})"),
            ]);
    }

    private function syncFamiliesWithArchive(Archive $archive)
    {
        $archive->families()
            ->syncWithPivotValues(listOfFamiliesBenefitingFromTheMonthlyBasketForExport()->map(function (FamilySponsorship $sponsorship) {
                return $sponsorship->family->id;
            }), ['tenant_id' => tenant('id')]);
    }

    private function decrementQuantities(Archive $archive)
    {
        $families_count = $archive->listFamilies()->count();

        Inventory::whereNotNull('qty_for_family')->where('type', '!=', 'baby_milk')
            ->where('type', '!=', 'diapers')->update([
                'qty' => Inventory::raw("qty - (qty_for_family * {$families_count})"),
            ]);
    }

    private function dispatchJob(Archive $archive)
    {
        dispatch(new MonthlyBasketFamiliesListSavedJob($archive, auth()->user()));
    }
}
