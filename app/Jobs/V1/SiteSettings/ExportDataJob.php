<?php

namespace App\Jobs\V1\SiteSettings;

use App\Exports\FullExports\BabiesExport;
use App\Exports\FullExports\BranchesExport;
use App\Exports\FullExports\FamiliesExport;
use App\Exports\FullExports\FinanceTransactionsExport;
use App\Exports\FullExports\InventoryExport;
use App\Exports\FullExports\LessonsExport;
use App\Exports\FullExports\NeedsExport;
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

        $this->exportOccasionsToExcel($zip);

        $zip->close();

        $this->cleanup();

        $tenant = Tenant::whereId($this->tenant)->first();

        $superAdmin = User::find($tenant->infos['super_admin']['id'])->first();

        Notification::send(
            $superAdmin,
            new ExportCompleteNotification(
                tenant: $tenant
            )
        );
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function exportToExcel(ZipArchive $zipArchive): void
    {
        $files = [
            __('the_members').'.xlsx' => new UsersExport,
            __('the_zones').'.xlsx' => new ZonesExport,
            __('the_branches').'.xlsx' => new BranchesExport,
            __('the_orphans').'.xlsx' => new OrphansExport,
            __('the_sponsors').'.xlsx' => new SponsorsExport,
            __('the_families').'.xlsx' => new FamiliesExport,
            __('the_schools').'.xlsx' => new SchoolsExport,
            __('the_lessons').'.xlsx' => new LessonsExport,
            __('the_needs').'.xlsx' => new NeedsExport,
            __('search.babies').'.xlsx' => new BabiesExport,
            __('the_inventory').'.xlsx' => new InventoryExport,
            __('exports.transactions').'.xlsx' => new FinanceTransactionsExport,
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

    private function exportOccasionsToExcel(ZipArchive $zip): void {}

    private function cleanup(): void {}
}
