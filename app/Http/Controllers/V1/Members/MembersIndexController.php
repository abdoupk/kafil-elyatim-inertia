<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use Inertia\Response;

class MembersIndexController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/members/MembersIndexPage');
    }
}
