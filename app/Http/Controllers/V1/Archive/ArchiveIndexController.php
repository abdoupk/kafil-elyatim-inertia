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
use Illuminate\Pagination\Paginator;
use Inertia\Inertia;

class ArchiveIndexController extends Controller
{
    public function __invoke()
    {
        $perPage = 10; // Number of items per page
        $currentPage = Paginator::resolveCurrentPage();
        $startIndex = ($currentPage - 1) * $perPage;

        $items = collect([
            Family::withTrashed()->get(),
            Orphan::withTrashed()->get(),
            Sponsor::withTrashed()->get(),
            Zone::withTrashed()->get(),
            Branch::withTrashed()->get(),
            Finance::withTrashed()->get(),
            PrivateSchool::withTrashed()->get(),
            Event::withTrashed()->get(),
        ])->flatten(1)->map(function ($item) {
            $modelInfo = $this->getNameFromModel($item);

            return [
                'type' => $modelInfo['type'],
                'name' => $modelInfo['name'],
                //                'deleted_at' => $item->deleted_at,
                //                'deleted_by' => $this->getDeletedByFromModel($item),
            ];
        });

        $totalItems = $items->count();
        $paginatedItems = new Paginator(
            $items->slice($startIndex, $perPage),
            $totalItems,
            $perPage
        );

        ray($paginatedItems);

        return Inertia::render('Tenant/archive/ArchiveIndexPage', [
            'test' => $paginatedItems,
        ]);
    }

    private function getNameFromModel($model)
    {
        $modelClass = get_class($model);

        return match ($modelClass) {
            Orphan::class, Family::class, Sponsor::class => [
                'name' => $model->getName(),
                'type' => $model->getTable(),
            ],
            Zone::class, Branch::class, PrivateSchool::class => ['name' => $model->name, 'type' => $model->getTable()],
            Finance::class => ['name' => $model->id, 'type' => $model->getTable()],
            Event::class => ['name' => $model->title, 'type' => 'lessons'],
            default => 'Unknown',
        };
    }
}
