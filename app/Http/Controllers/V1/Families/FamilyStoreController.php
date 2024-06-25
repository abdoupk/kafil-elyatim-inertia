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
                'name' => $request->validated('spouse.first_name').'  '.$request->validated('spouse.last_name'),
                ...$request->only('address', 'zone_id', 'file_number', 'start_date', 'report'),
            ]
        );

        $family->sponsor()->create([...$request->validated('sponsor'), 'created_by' => auth()->id()]);

        $family->orphans()->createMany(array_map(static function ($orphan) {
            $orphan['created_by'] = auth()->id();

            return $orphan;
        }, $request->validated('orphans')));

        $family->secondSponsor()->create($request->validated('second_sponsor'));

        $family->deceased()->create($request->validated('spouse'));

        return to_route('tenant.families.show', $family); //TODO fix redirect not working
    }
}
