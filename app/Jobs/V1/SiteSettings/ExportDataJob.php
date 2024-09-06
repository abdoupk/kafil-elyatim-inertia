<?php

namespace App\Jobs\V1\SiteSettings;

use App\Exports\FullExports\UsersExport;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\SiteSettings\ExportCompleteNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Notification;
use PhpOffice\PhpSpreadsheet\Exception;
use Storage;
use ZipArchive;

class ExportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $path, public string $tenant) {}

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle(): void
    {
        $zip = new ZipArchive;

        $zip->open($this->path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $this->exportToExcel($zip);

        $tenant = Tenant::whereId($this->tenant)->first();

        $superAdmin = User::find($tenant->infos['super_admin']['id'])->first();

        Notification::send(
            $superAdmin,
            new ExportCompleteNotification(
                tenant: $tenant
            )
        );

        ray('Exported');
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function exportToExcel(ZipArchive $zipArchive): void
    {
        $files = [
            __('the_members').'.xlsx' => new UsersExport,
            //            __('the_zones').'.xlsx' => new ZonesExport,
            //            __('the_branches').'.xlsx' => new BranchesExport,
            //            __('the_orphans').'.xlsx' => new OrphansExport,
            //            __('the_sponsors').'.xlsx' => new SponsorsExport,
            //            __('the_families').'.xlsx' => new FamiliesExport,
            //            __('the_schools').'.xlsx' => new SchoolsExport,
            //            __('the_lessons').'.xlsx' => new LessonsExport,
            //            __('exports.transactions').'.xlsx' => new FinanceTransactionsExport,
            //            __('exports.eid_suit').'.xlsx' => new OccasionsOrphansExport('eid_suit'),
            //            __('exports.eid_al_adha_families').'.xlsx' => new OccasionsFamiliesExport('eid_al_adha'),
            //            __('exports.babies_milk_and_diapers').'.xlsx' => new BabiesMilkAndDiapersListExport,
            //            __('exports.monthly_basket_families').'.xlsx' => new OccasionsFamiliesExport('monthly_basket'),
            //            __('exports.ramadan_basket_families').'.xlsx' => new OccasionsFamiliesExport('ramadan_basket'),
            //            __('exports.school_entry').'.xlsx' => new OccasionsOrphansExport('school_entry'),
        ];

        foreach ($files as $fileName => $export) {
            Excel::store($export, $fileName);

            $zipArchive->addFile(Storage::path($fileName), $fileName);
        }

        $zipArchive->close();

        foreach ($files as $fileName => $export) {
            Storage::delete($fileName);
        }
    }
}
