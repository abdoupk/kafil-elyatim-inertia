<?php

namespace App\Http\Controllers\V1\Families;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Families\CreateFamilyRequest;
use App\Models\Family;
use Illuminate\Http\RedirectResponse;

class FamilyStoreController extends Controller
{
    public function __invoke(CreateFamilyRequest $request): RedirectResponse
    {
        $family = Family::create(
            [
                ...$request->only('address', 'zone_id', 'file_number', 'start_date', 'report', 'preview_date'),
                'name' => $request->validated('spouse.first_name').'  '.$request->validated('spouse.last_name'),
            ]
        );

        $sponsor = $family->sponsor()->create([...$request->validated('sponsor'), 'created_by' => auth()->id()]);

        $sponsor->incomes()->create($request->validated('incomes'));

        $family->orphans()->createMany(array_map(static function ($orphan) {
            $orphan['created_by'] = auth()->id();

            return $orphan;
        }, $request->validated('orphans')));

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

        return to_route('tenant.families.show', $family); //TODO fix redirect not working
    }
}
