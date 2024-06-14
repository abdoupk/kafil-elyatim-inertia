<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Families\FamiliesIndexResource;
use App\Models\Family;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $request->validate([
            'directions.*' => ['in:asc,desc'],
        ]);

        $perPage = $request->input('perPage', 10);

        $search = $request->input('search', '') ?? '';

        $families = $this->searchFamilies($search, $request->input('directions'), $perPage);

        return inertia()->render('Tenant/families/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection($families),
            'filters' => [
                'page' => $request->input('page', 1),
                'search' => $request->input('search') ?? '',
                'perPage' => $request->input('perPage', 10),
            ],
        ]);
    }

    private function searchFamilies(string $search, ?array $directions, int $perPage): Builder
    {
        $query = Family::search($search, function ($meilisearch) use ($directions, $search) {
            $options = [];

            if ($directions) {
                $options['sort'] = array_map(static function ($value, $key) {
                    if (in_array($key, ['name', 'file_number', 'created_at', 'start_date'])) {
                        return "$key:$value";
                    }

                    return 'name:desc';
                }, array_values($directions), array_keys($directions));
            } else {
                $options['sort'] = ['name:desc'];
            }

            return $meilisearch->search($search, $options);
        });

        return $query->whereHas('zone')->paginate($perPage);
    }
}
