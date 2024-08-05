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
                    {{ __('health_status') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('phone_number') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('filters.sponsor_type') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('orphans_count') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    ccp
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('academic_level') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('filters.gender') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('diploma') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('income') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('filters.birth_date') }}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($sponsors as $sponsor)
                <tr>
                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->getName() }}
                    </td>

                    <td class="px-2 py-0.5 whitespace-nowrap border text-center border-black">
                        {{ $sponsor->formattedPhoneNumber() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ __($sponsor->sponsor_type) }}
                    </td>

                    <td class="px-2 py-0.5 border border-black text-center">
                        {{ $sponsor->academicLevel->level }}

                        <p class="mt-0.5 text-sm text-slate-500">({{ $sponsor->academicLevel->phase }})</p>
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ __($sponsor->gender) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->orphans_count }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->ccp }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->diploma }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->incomes->total_income }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->birth_date->format('Y/m/d') }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $sponsor->birth_date->format('Y/m/d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
