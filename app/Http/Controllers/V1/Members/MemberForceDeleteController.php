<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Models\User;

class MemberForceDeleteController extends Controller
{
    public function __invoke(User $member) {}
}
