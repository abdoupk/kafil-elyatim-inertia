<?php

namespace App\Http\Controllers\V1\Trash;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Inertia\Inertia;
use Inertia\Response;

class TrashIndexController extends Controller
{
    public function __invoke(): Response
    {
        $perPage = request()->integer('perPage', 10);
        $currentPage = Paginator::resolveCurrentPage();
        $startIndex = ($currentPage - 1) * $perPage;

        $unionQuery = "
    (
        SELECT
            f.id,
            f.name,
            f.deleted_at,
            u.id AS user_id,
            CONCAT(u.first_name, ' ', u.last_name) AS user_name,
            'tenant.families.restore' AS restore_url,
            'tenant.families.force-delete' AS force_delete_url,
            'families' AS type
        FROM families f
        LEFT JOIN users u ON f.deleted_by = u.id
        WHERE f.deleted_at IS NOT NULL AND f.tenant_id = :tenant_id
    )
    UNION ALL
    (
        SELECT
            o.id,
            o.first_name AS name,
            o.deleted_at,
            u.id AS user_id,
            CONCAT(u.first_name, ' ', u.last_name) AS user_name,
            'tenant.orphans.restore' AS restore_url,
            'tenant.orphans.force-delete' AS force_delete_url,
            'orphans' AS type
        FROM orphans o
        LEFT JOIN users u ON o.deleted_by = u.id
        WHERE o.deleted_at IS NOT NULL AND o.tenant_id = :tenant_id
    )
    UNION ALL
    (
        SELECT
            s.id,
            s.first_name AS name,
            s.deleted_at,
            u.id AS user_id,
            CONCAT(u.first_name, ' ', u.last_name) AS user_name,
            'tenant.sponsors.restore' AS restore_url,
            'tenant.sponsors.force-delete' AS force_delete_url,
            'sponsors' AS type
        FROM sponsors s
        LEFT JOIN users u ON s.deleted_by = u.id
        WHERE s.deleted_at IS NOT NULL AND s.tenant_id = :tenant_id
    )";
        $items = DB::table(DB::raw("($unionQuery) AS temp_table"))
            ->offset($startIndex)
            ->limit($perPage)
            ->orderByDesc('deleted_at')
            ->setBindings(['tenant_id' => tenant('id')])
            ->get();

        $totalItems = DB::table(DB::raw("($unionQuery) AS temp_table"))
            ->orderByDesc('deleted_at')
            ->setBindings(['tenant_id' => tenant('id')])
            ->count();

        $paginated = (new LengthAwarePaginator(
            $items,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()],
        ));

        $data = $paginated->toArray();

        $data['meta'] = [
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'total' => $paginated->total(),
            'per_page' => $paginated->perPage(),
            'from' => $paginated->firstItem(),
            'to' => $paginated->lastItem(),
            'path' => $paginated->path(),
        ];

        return Inertia::render('Tenant/trash/TrashIndexPage', [
            'items' => $data,
            'params' => getParams(),
        ]);
    }
}
