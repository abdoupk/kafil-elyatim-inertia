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

    <div class="m-2">
        <table class="w-full table table-bordered border-black text-black">
            <thead>
                <tr>
                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        <span> #</span>
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('the_sponsor') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('validation.attributes.address') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('file_number') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('validation.attributes.starting_sponsorship_date') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('the_branch') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('the_zone') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('orphans_count') }}
                    </th>

                    <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                        {{ __('incomes.label.total_income') }}
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($families as $family)
                    <tr>
                        <td class="px-2 py-1 border border-black">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-2 py-1 border border-black">
                            {{ $family->sponsor->getName() }}
                        </td>

                        <td class="px-2 py-1 border border-black">
                            {{ $family->address }}
                        </td>

                        <td class="px-2 py-1 border border-black text-center">
                            {{ $family->file_number }}
                        </td>

                        <td class="px-2 py-1 whitespace-nowrap border border-black text-center">
                            {{ $family->start_date->format('Y-m-d') }}
                        </td>

                        <td class="px-2 py-1 border border-black">
                            {{ $family->branch->name }}
                        </td>

                        <td class="px-2 py-1 border border-black whitespace-nowrap">
                            {{ $family->zone->name }}
                        </td>

                        <td class="px-2 py-1 border border-black text-center">
                            {{ $family->orphans_count }}
                        </td>

                        <td class="px-2 py-1 border border-black">
                            {{-- TODO use Money Package --}}
                            {{ number_format($family->totalIncomes(), 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
