<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Branch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/** @noinspection NullPointerExceptionInspection
 * @noinspection StaticClosureCanBeUsedInspection
 */
function getBranches(): LengthAwarePaginator
{
    /** @phpstan-ignore-next-line */
    return Branch::search(request()->input('search', ''),
        function ($meilisearch, string $query, array $meilisearchOptions) {
            $meilisearchOptions['filter'] = generateFilterConditions();

            $meilisearchOptions['sort'] = generateFormattedSort();

            return $meilisearch->search($query, $meilisearchOptions);
        }
    )->query(fn (Builder $query) => $query->with(['president', 'city']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()->input('perPage', 10));
}
