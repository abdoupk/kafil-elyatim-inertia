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
                    {{ __('the_orphan') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('health_status') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('family_status') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('academic_level') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('shoes_size') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('pants_size') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('shirt_size') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('filters.gender') }}
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

            @foreach ($orphans as $orphan)
                <tr>
                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->getName() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->health_status }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->family_status }}
                    </td>

                    <td class="px-2 py-0.5 border border-black text-center">
                        {{ $orphan->academicLevel->level }}

                        <p class="mt-0.5 text-sm text-slate-500">({{ $orphan->academicLevel->phase }})</p>
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->shoes_size }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->pants_size }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->shirt_size }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ __($orphan->gender) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->income }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $orphan->birth_date->format('Y/m/d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
