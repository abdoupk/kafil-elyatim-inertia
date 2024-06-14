<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;

class FamilyCreateController extends Controller
{
    public function __invoke()
    {
        return inertia('Tenant/families/FamilyCreatePage');
    }
}
