<?php

use App\Models\Archive;
use Illuminate\Pagination\LengthAwarePaginator;

function getArchives(): LengthAwarePaginator
{
    return search(Archive::getModel())
        ->query(fn ($query) => $query->with('savedBy'))
        ->paginate(perPage: (int) request()?->input('perPage', 10));
}
