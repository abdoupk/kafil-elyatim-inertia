<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\FamilyHousingUpdateRequest;
use App\Models\Family;

class FamilyUpdateHousingController extends Controller
{
    public function __invoke(FamilyHousingUpdateRequest $request, Family $family) {}
}
