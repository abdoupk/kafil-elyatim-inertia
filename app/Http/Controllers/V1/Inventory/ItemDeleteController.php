<?php

namespace App\Http\Controllers\V1\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;

class ItemDeleteController extends Controller
{
    public function __invoke(Inventory $item)
    {
        $item->delete();

        return redirect()->back();
    }
}
