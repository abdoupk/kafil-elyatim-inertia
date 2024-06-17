<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;

class FamilyDeleteController extends Controller
{
    public function __invoke(Family $family)
    {
        $family->delete();

        return redirect()->back();
    }
}
