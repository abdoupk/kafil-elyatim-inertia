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
            {{ __('filters.gender') }}
        </th>

        <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
            {{ __('age') }}
        </th>

        <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
            {{ __('baby_milk_type') }}
        </th>

        <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
            {{ __('baby_milk_quantity') }}
        </th>

        <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
            {{ __('diapers_type') }}
        </th>

        <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
            {{ __('diapers_quantity') }}
        </th>
    </tr>
    </thead>

    <tbody>

    @foreach ($babies as $baby)
        <tr>
            <td class="px-2 py-0.5 border text-center border-black">
                {{ $loop->iteration }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ $baby->orphan->sponsor->getName() }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{$baby->orphan->sponsor->formattedPhoneNumber()}}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ $baby->getName() }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ __($baby->orphan->gender) }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ calculateAge($baby->orphan->birth_date) }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ $baby->baby_milk_type }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{ $baby->baby_milk_quantity }}
            </td>

            <td class="px-2 py-0.5 border text-center border-black">
                {{$baby->diapers_type }}
            </td>

            <td class="px-2 py-0.5 border border-black text-center">
                {{ $baby->diapers_quantity }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>

</html>
