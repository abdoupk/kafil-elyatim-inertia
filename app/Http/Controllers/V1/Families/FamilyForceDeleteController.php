<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;

class FamilyForceDeleteController extends Controller
{
    public function __invoke(Family $family)
    {
        return redirect()->back();
    }
}
