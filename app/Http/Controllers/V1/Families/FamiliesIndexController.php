<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Families\FamiliesIndexResource;
use App\Models\Family;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $request->validate([
            'directions.*' => ['in:asc,desc'],
        ]);

        $families = $this->search(
            $request->get('search', ''),
            $request->input('directions'),
            $request->get('perPage', 10)
        );

        return Inertia::render('Tenant/families/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection($families),
            'filters' => [
                'page' => (int) $request->get('page', 1),
                'search' => $request->input('search') ?? '',
                'perPage' => $request->input('perPage', 10),
            ],
        ]);
    }

    private function search(string $search, ?array $directions, int $perPage): LengthAwarePaginator
    {
        return Family::search($search, static function ($meilisearch, string $query, array $options) use ($directions) {

            if ($directions) {
                $formattedSort = array_map(static function ($value, $key) {
                    $searchableFields = ['name', 'name', 'file_number', 'created_at', 'start_date'];

                    if (in_array($key, $searchableFields, true)) {
                        return "$key:$value";
                    }

                    return 'name:desc';
                }, array_values($directions), array_keys($directions));
                $options['sort'] = array_values($formattedSort);
            } else {
                $options['sort'] = ['name:desc'];
            }

            return $meilisearch->search($query, $options);
        })
            ->query(fn (Builder $query) => $query->whereHas('zone'))
            ->paginate(perPage: $perPage);
    }
}
