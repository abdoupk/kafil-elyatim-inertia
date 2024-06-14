<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $a = Family::search($request->input('search', ''))->orderBy(
            $request->input('field', 'created_at'),
            $request->input('direction', 'asc')
        )
            ->paginate(perPage: $request->input('perPage', 10));

        $paginationMetrics = [
            'total' => $a->total(),
            'from' => $a->firstItem(),
            'to' => $a->lastItem(),
        ];
        ray($paginationMetrics);

        return inertia()->render('Tenant/families/FamiliesIndexPage', [
            'families' => $a,
            'paginationMetrics' => $paginationMetrics,
            'filters' => [
                'search' => $request->input('search') ?? '',
                'perPage' => $request->input('perPage', 10),
                'field' => $request->input('field', 'name'),
                'direction' => $request->input('direction', 'asc'),
            ],
        ]);
    }
}
