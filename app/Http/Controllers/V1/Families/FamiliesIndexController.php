<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Inertia\Response;

class FamiliesIndexController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/families/FamiliesIndexPage', [
            'families' => Family::paginate(10),
        ]);
    }
}
