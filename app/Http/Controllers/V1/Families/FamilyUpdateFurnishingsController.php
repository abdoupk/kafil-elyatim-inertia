<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilyFurnishingsUpdateRequest;
use App\Models\Family;

class FamilyUpdateFurnishingsController extends Controller
{
    public function __invoke(FamilyFurnishingsUpdateRequest $request, Family $family) {}
}
