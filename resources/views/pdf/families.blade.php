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
        <table class="w-full table table-bordered border-black">
            <thead>
                <tr>
                    <th class="whitespace-nowrap font-medium px-5 py-3 border border-black">
                        <span> #</span>
                    </th>
                    <th class="whitespace-nowrap font-medium px-5 py-3 border border-black">
                        العائلة
                    </th>
                    <th class="whitespace-nowrap font-medium px-5 py-3 border border-black">
                        العنوان
                    </th>
                    <th class="whitespace-nowrap font-medium px-5 py-3 border border-black">
                        رقم الملف
                    </th>
                    <th class="whitespace-nowrap font-medium px-5 py-3 border border-black">
                        تاريخ بدء التكفل
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($families as $family)
                    <tr>
                        <td class="px-5 py-3 border border-black">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3 border border-black">
                            {{ $family->name }}
                        </td>
                        <td class="px-5 py-3 border border-black">
                            {{ $family->address }}
                        </td>
                        <td class="px-5 py-3 border border-black">
                            {{ $family->file_number }}
                        </td>
                        <td class="px-5 py-3 border border-black">
                            {{ $family->start_date->format('Y-m-d') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
