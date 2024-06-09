<?php

namespace App\Http\Controllers\V1\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function wilayas(): JsonResponse
    {
        return response()->json([
            'wilayas' => City::select([
                'wilaya_code',
                'wilaya_name',
            ])->orderBy('wilaya_code')
                ->groupBy(['wilaya_code', 'wilaya_name'])
                ->get(),
        ]);
    }

    public function dairas(Request $request): JsonResponse
    {
        return response()->json(City::select([
            'id',
            'wilaya_code',
            'daira_name',
        ])->where(DB::raw('daira_name'), DB::raw('commune_name'))
            ->where('wilaya_code', '=', $request->wilaya_code)
            ->get());
    }

    public function communes(Request $request): JsonResponse
    {
        return response()->json(City::select([
            'id',
            'commune_name',
        ])->where('daira_name', '=', $request->daira_name)
            ->where('wilaya_code', '=', $request->wilaya_code)
            ->get());
    }
}
