<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Event;
use App\Models\Family;
use App\Models\Finance;
use App\Models\Orphan;
use App\Models\PrivateSchool;
use App\Models\Sponsor;
use App\Models\Zone;
use DB;
use Illuminate\Pagination\Paginator;
use Inertia\Inertia;

class ArchiveIndexController extends Controller
{
    public function __invoke()
    {
        $perPage = 10; // Number of items per page
        $currentPage = Paginator::resolveCurrentPage();
        $startIndex = ($currentPage - 1) * $perPage;
        ray($currentPage, $startIndex);
        $items = DB::table('families')
            ->select('id', 'name')
            ->unionAll(
                DB::table('orphans')
                    ->select('id', 'first_name as name')
            )
            ->unionAll(
                DB::table('sponsors')
                    ->select('id', 'first_name as name')
            )
            ->unionAll(
                DB::table('zones')
                    ->select('id', 'name')
            )
            ->unionAll(
                DB::table('branches')
                    ->select('id', 'name')
            )
            ->unionAll(
                DB::table('private_schools')
                    ->select('id', 'name')
            )
            ->unionAll(
                DB::table('events')
                    ->select('id', 'title as name')
            )
            ->offset($startIndex)
            ->limit($perPage)
            ->get();

        $paginatedItems = new Paginator(
            $items,
            $items->count(),
            $perPage
        );

        return Inertia::render('Tenant/archive/ArchiveIndexPage', [
            'test' => $paginatedItems,
        ]);
    }

    private function getNameFromModel($model)
    {
        $modelClass = get_class($model);

        switch ($modelClass) {
            case Orphan::class:
            case Family::class:
            case Sponsor::class:
                return [
                    'name' => $model->getName(),
                    'type' => $model->getTable(),
                ];

            case Zone::class:
            case Branch::class:
            case PrivateSchool::class:
                return [
                    'name' => $model->name,
                    'type' => $model->getTable(),
                ];

            case Finance::class:
                return [
                    'name' => $model->id,
                    'type' => $model->getTable(),
                ];

            case Event::class:
                return [
                    'name' => $model->title,
                    'type' => 'lessons',
                ];

            default:
                return 'Unknown';
        }
    }
}
