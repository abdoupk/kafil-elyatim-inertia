<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FamiliesIndexResource;
use App\Models\Family;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $directions = $request->input('directions');

        $search = $request->input('search') ?? '';

        $families = Family::search($search, static function ($meilisearch, string $query, array $options) use ($directions) {
            if ($directions) {
                $formattedSort = array_map(static function ($value, $key) {
                    return "$key:$value";
                }, array_values($directions), array_keys($directions));
                $options['sort'] = array_values($formattedSort);
            } else {
                $options['sort'] = ['name:desc'];
            }

            return $meilisearch->search($query, $options);
        })
            ->query(fn (Builder $query) => $query->whereHas('zone'))
            ->paginate(perPage: $request->input('perPage', 10))->withQueryString();

        return inertia()->render('Tenant/families/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection($families),
            'filters' => [
                'page' => $request->input('page', 1),
                'search' => $request->input('search') ?? '',
                'perPage' => $request->input('perPage', 10),
            ],
        ]);
    }
}
