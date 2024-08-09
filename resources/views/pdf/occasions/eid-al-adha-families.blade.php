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
                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    <span> #</span>
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('the_sponsor') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-1 border border-black">
                    {{ __('sponsor_phone_number') }}
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
            </tr>
        </thead>

        <tbody>

            @foreach ($sponsorships as $sponsorship)
                <tr>
                    <td class="px-2 py-1 border border-black text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $sponsorship->family->sponsor->getName() }}
                    </td>

                    <td class="px-2 py-1 border border-black text-center">
                        {{ $sponsorship->family->sponsor->formattedPhoneNumber() }}
                    </td>

                    <td class="px-2 py-1 border border-black">
                        {{ $sponsorship->family->address }}
                    </td>

                    <td class="px-2 py-1 border border-black text-center">
                        {{ $sponsorship->family->orphans->count() }}
                    </td>

                    <td class="px-2 py-1 whitespace-nowrap border border-black text-center">
                        {{ formatCurrency($sponsorship->family->totalIncomes()) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
