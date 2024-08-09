<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <table class="w-full table table-bordered border-black text-black">
        <thead>
            <tr>
                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    <span> #</span>
                </th>
                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('the_sponsor') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('sponsor_phone_number') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('the_orphan') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('academic_level') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('filters.gender') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('age') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('the_zone') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('validation.attributes.address') }}
                </th>
            </tr>
        </thead>

        <tbody>
            @php(ray($sponsorships))
            @foreach ($sponsorships as $sponsorship)
                <tr>
                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsorship->orphan->sponsor->getName() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsorship->orphan->sponsor->formattedPhoneNumber() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsorship->orphan->getName() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsorship->orphan->lastAcademicYearAchievement?->academicLevel->level }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ __($sponsorship->orphan->gender) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ trans_choice('age_years', $sponsorship->orphan->birth_date->age) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsorship->orphan->family->zone->name }}
                    </td>

                    <td class="px-2 py-0.5 border border-black">
                        {{ $sponsorship->orphan->family->address }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
