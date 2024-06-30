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
    <table class="w-full table table-bordered">
        <thead>
            <tr>
                <th class="whitespace-nowrap font-medium px-5 py-3 border-b-2 border-l border-r border-t">
                    <span> #</span>
                </th>
                <th class="whitespace-nowrap font-medium px-5 py-3 border-b-2 border-l border-r border-t">
                    العائلة
                </th>
                <th class="whitespace-nowrap font-medium px-5 py-3 border-b-2 border-l border-r border-t">
                    العنوان
                </th>
                <th class="whitespace-nowrap font-medium px-5 py-3 border-b-2 border-l border-r border-t">
                    رقم الملف
                </th>
                <th class="whitespace-nowrap font-medium px-5 py-3 border-b-2 border-l border-r border-t">
                    تاريخ بدء التكفل
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($families as $family)
                <tr>
                    <td class="px-5 py-3 border-b border-l border-r border-t">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-5 py-3 border-b border-l border-r border-t">
                        {{ $family->name }}
                    </td>
                    <td class="px-5 py-3 border-b border-l border-r border-t">
                        {{ $family->address }}
                    </td>
                    <td class="px-5 py-3 border-b border-l border-r border-t">
                        {{ $family->file_number }}
                    </td>
                    <td class="px-5 py-3 border-b border-l border-r border-t">
                        {{ $family->start_date->format('Y-m-d') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
