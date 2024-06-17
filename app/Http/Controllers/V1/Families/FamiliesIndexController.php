<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Families\FamiliesIndexResource;
use App\Models\Family;
use Auth;
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
            'perPage' => ['integer', 'min:10', 'in:10,25,35,50'],
            'page' => ['integer', 'min:1'],
            'search' => ['string', 'max:255'],
        ]);

        $families = $this->search(
            $request->get('search', ''),
            $request->input('directions'),
            $request->get('perPage', 10)
        );

        return Inertia::render('Tenant/families/index/FamiliesIndexPage', [
            'families' => FamiliesIndexResource::collection($families),
            'filters' => [
                'page' => (int) $request->get('page', 1),
                'search' => $request->input('search') ?? '',
                'perPage' => $request->input('perPage', 10),
                'fields' => $request->input('fields'),
                'directions' => $request->input('directions'),
            ],
        ]);
    }

    private function search(string $search, ?array $directions, int $perPage): LengthAwarePaginator
    {
        $families = Family::search($search);

        if ($directions) {
            foreach ($directions as $column => $direction) {
                $families->orderBy($column, $direction);
            }
        }

        if (! Auth::user()?->hasRole(['president', 'vice_president'])) {
            $families->where('zone_id', Auth::user()?->zone_id);
        }

        return $families->query(fn (Builder $query) => $query->with('zone'))
            ->paginate(perPage: $perPage);
    }
}
