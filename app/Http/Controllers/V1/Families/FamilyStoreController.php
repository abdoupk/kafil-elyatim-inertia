<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\CreateFamilyRequest;
use App\Models\Family;

class FamilyStoreController extends Controller
{
    public function __invoke(CreateFamilyRequest $request): void
    {
        Family::create($request->only('name', 'address', 'zone', 'file_number', 'start_date'));
    }
}
