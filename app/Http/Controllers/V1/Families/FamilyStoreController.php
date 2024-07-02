<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\CreateFamilyRequest;
use App\Models\Family;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class FamilyStoreController extends Controller
{
    public function __invoke(CreateFamilyRequest $request): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $family = Family::create(
            [
                ...$request->only('address', 'zone_id', 'file_number', 'start_date', 'branch_id'),
                'name' => $request->validated('spouse.first_name').'  '.$request->validated('spouse.last_name'),
            ]
        );

        $sponsor = $family->sponsor()->create([...$request->validated('sponsor'), 'created_by' => auth()->id()]);

        $sponsor->incomes()->create($request->validated('incomes'));

        $preview = $family->preview()->create([
            'preview_date' => $request->validated('preview_date'),
            'report' => $request->validated('report'),
        ]);

        $preview->inspectors()->sync($request->validated('inspectors_members'));

        $orphans = $family->orphans()->createMany(array_map(static function ($orphan) {
            $orphan['created_by'] = auth()->id();

            return array_filter($orphan, function ($key) {
                return ! in_array($key, ['baby_milk_quantity', 'baby_milk_type', 'diapers_quantity', 'diapers_type']);
            }, ARRAY_FILTER_USE_KEY);
        }, $request->validated('orphans')));

        ray($orphans);

        $family->secondSponsor()->create($request->validated('second_sponsor'));

        $family->deceased()->create($request->validated('spouse'));

        $family->housing()->create([
            'name' => $request->validated('housing.housing_type.value'),
            'value' => $request->validated('housing.housing_type.name'),
            'number_of_rooms' => $request->validated('housing.number_of_rooms'),
            'housing_receipt_number' => $request->validated('housing.housing_receipt_number'),
            'other_properties' => $request->validated('other_properties'),
        ]);

        $family->furnishings()->create($request->validated('furnishings'));

        return response(['family' => $family->id], 201);
    }
}
