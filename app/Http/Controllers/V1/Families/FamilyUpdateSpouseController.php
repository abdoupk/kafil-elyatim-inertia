<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilySpouseUpdateRequest;
use App\Jobs\V1\Family\FamilyUpdatedJob;
use App\Models\Family;
use Illuminate\Routing\Controllers\HasMiddleware;

class FamilyUpdateSpouseController extends Controller implements HasMiddleware
{
    public function __invoke(FamilySpouseUpdateRequest $request, Family $family)
    {
        $family->deceased()->update($request->validated());

        dispatch(new FamilyUpdatedJob($family, auth()->user()));

        return response('', 201);
    }

    public static function middleware()
    {
        return ['can:update_families'];
    }
}
