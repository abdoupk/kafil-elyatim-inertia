<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .w-full {
            width: 100%
        }

        .table {
            border-collapse: collapse
        }

        .border {
            border: 1px solid
        }

        .border-black {
            border-color: black
        }

        .text-black {
            color: black
        }

        .font-medium {
            font-weight: 500
        }

        .px-2 {
            padding-left: .5rem;
            padding-right: .5rem
        }

        .px-3 {
            padding-left: .75rem;
            padding-right: .75rem
        }

        .py-1 {
            padding-top: .25rem;
            padding-bottom: .25rem
        }

        .text-center {
            text-align: center
        }

        .whitespace-nowrap {
            white-space: nowrap
        }
    </style>
</head>

<body>
    <table class="w-full table border-black text-black">
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
                    {{ __('orphans_count') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('incomes.label.total_income') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('income_rate') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('the_branch') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('the_zone') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('file_number') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('validation.attributes.starting_sponsorship_date') }}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($families as $family)
                <tr>
                    <td class="px-2 py-1 border border-black text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $family->sponsor->getName() }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $family->address }}
                    </td>

                    <td class="px-2 py-1 border border-black text-center">
                        {{ $family->orphans_count }}
                    </td>

                    <td class="px-2 py-1 whitespace-nowrap border border-black text-center">
                        {{ formatCurrency($family->totalIncomes()) }}
                    </td>

                    <td class="px-2 py-1 whitespace-nowrap border border-black text-center">
                        {{ $family->income_rate }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $family->branch->name }}
                    </td>

                    <td class="px-2 py-1 border border-black whitespace-nowrap">
                        {{ $family->zone->name }}
                    </td>

                    <td class="px-2 py-1 border border-black text-center">
                        {{ $family->file_number }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $family->start_date->format('Y/m/d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
