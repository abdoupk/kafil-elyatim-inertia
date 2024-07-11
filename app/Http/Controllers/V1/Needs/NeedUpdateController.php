<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Needs\NeedUpdateRequest;
use App\Models\Need;

class NeedUpdateController extends Controller
{
    public function __invoke(NeedUpdateRequest $request, Need $need)
    {
        $need->update($request->only(['status', 'subject', 'demand', 'note']));

        return response('', 201);
    }
}
