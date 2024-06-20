<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class MemberCreateController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/members/MemberCreatePage');
    }
}
