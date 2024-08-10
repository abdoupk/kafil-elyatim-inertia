<?php

namespace App\Http\Controllers\V1\Trash;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class TrashIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/trash/TrashIndexPage');
    }
}
