<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Orphans\OrphanInfosUpdateRequest;
use App\Models\Orphan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class OrphanUpdateInfosController extends Controller
{
    public function __invoke(OrphanInfosUpdateRequest $request, Orphan $orphan): ResponseFactory|Application|Response
    {
        $orphan->update([
            ...$request->except(['baby_milk_quantity', 'baby_milk_type', 'diapers_quantity', 'diapers_type']),

            'shirt_size' => $request->shirt_size['id'],
            'shoes_size' => $request->shoes_size['id'],
            'pants_size' => $request->pants_size['id'],
        ]);

        if (now()->diff($orphan->birth_date)->y < 2) {
            $orphan->babyNeeds()->update($request->only(['baby_milk_quantity', 'baby_milk_type', 'diapers_quantity', 'diapers_type']));
        }

        return response('', 201);
    }
}
