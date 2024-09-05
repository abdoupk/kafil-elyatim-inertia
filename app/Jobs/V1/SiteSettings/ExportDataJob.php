<?php

namespace App\Jobs\V1\SiteSettings;

use App\Exports\FullExports\BranchesExport;
use App\Exports\FullExports\FamiliesExport;
use App\Exports\FullExports\FinanceTransactionsExport;
use App\Exports\FullExports\LessonsExport;
use App\Exports\FullExports\OccasionsExport;
use App\Exports\FullExports\OrphansExport;
use App\Exports\FullExports\SchoolsExport;
use App\Exports\FullExports\SponsorsExport;
use App\Exports\FullExports\UsersExport;
use App\Exports\FullExports\ZonesExport;
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

    public function __construct(public string $tenant) {}

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle(): void
    {
        ray('Exported 0');
        $zipFilePath = "exports/$this->tenant.zip";

        $zip = new ZipArchive;

        $zip->open(Storage::path($zipFilePath), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $this->exportToExcel($zip);

        $zip->close();

        $superAdmin = User::find(Tenant::whereId($this->tenant)->first()->infos['super_admin']['id']);

        Notification::send(
            $superAdmin,
            new ExportCompleteNotification(
                zipFilePath: $zipFilePath,
                user: $superAdmin
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
            __('members').'.xlsx' => new UsersExport,
            __('zones').'.xlsx' => new ZonesExport,
            __('branches').'.xlsx' => new BranchesExport,
            __('orphans').'.xlsx' => new OrphansExport,
            __('sponsors').'.xlsx' => new SponsorsExport,
            __('families').'.xlsx' => new FamiliesExport,
            __('the_schools').'.xlsx' => new SchoolsExport,
            __('the_lessons').'.xlsx' => new LessonsExport,
            __('exports.transactions').'.xlsx' => new FinanceTransactionsExport,
            __('exports.eid_suit').'.xlsx' => new OccasionsExport('eid_suit'),
            __('exports.eid_al_adha_families').'.xlsx' => new OccasionsExport('eid_al_adha'),
            __('exports.babies_milk_and_diapers').'.xlsx' => new OccasionsExport('babies_milk_and_diapers'),
            __('exports.monthly_basket_families').'.xlsx' => new OccasionsExport('monthly_basket'),
            __('exports.ramadan_basket_families').'.xlsx' => new OccasionsExport('ramadan_basket'),
            __('exports.school_entry').'.xlsx' => new OccasionsExport('school_entry'),
        ];

        foreach ($files as $fileName => $export) {
            Excel::store($export, $fileName, 'local');

            $zipArchive->addFile(Storage::path($fileName), $fileName);

            Storage::delete($fileName);
        }
    }
}
