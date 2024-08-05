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

                @foreach ($orphans as $orphan)
                    <tr>
                        <td class="px-2 py-1 border border-black">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-2 py-1 border border-black">
                            {{ $orphan->getName() }}
                        </td>

                        <td class="px-2 py-1 border border-black">

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
