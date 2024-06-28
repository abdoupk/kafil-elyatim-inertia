<?php

namespace App\Http\Controllers\V1\Members;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class MemberDeleteController extends Controller
{
    public function __invoke(User $member): RedirectResponse
    {
        $member->delete();

        return redirect()->back();
    }
}
