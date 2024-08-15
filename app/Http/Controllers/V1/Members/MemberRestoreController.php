<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Models\User;

class MemberRestoreController extends Controller
{
    public function __invoke(User $member)
    {
        $member->restore();

        return redirect()->back();
    }
}
