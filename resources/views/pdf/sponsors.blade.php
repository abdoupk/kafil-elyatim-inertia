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
    <div class="col-span-12 overflow-auto md:block ">
        <table class="w-full text-start mt-2 border-separate border-spacing-y-[10px]">
            <thead class="">
                <tr class="">
                    <th
                        class="px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-start font-semibold flex-col">
                        <span> #</span>
                    </th>
                    <th
                        class="px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-start font-semibold flex-col">
                        <div class="flex cursor-pointer"><span class="flex-grow">العائلة</span></div>
                    </th>
                    <th
                        class="px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-start font-semibold flex-col">
                        <span>العنوان</span>
                    </th>
                    <th
                        class="px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-center font-semibold flex-col">
                        <div class="flex cursor-pointer"><span class="flex-grow">رقم الملف</span></div>
                    </th>
                    <th
                        class="px-5 py-3 dark:border-darkmode-300 whitespace-nowrap border-b-0 text-center font-semibold flex-col">
                        <div class="flex cursor-pointer"><span class="flex-grow">تاريخ بدء التكفل</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sponsors as $sponsor)
                    <tr>
                        <td
                            class="px-5 py-3 dark:border-darkmode-300 w-16 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]">
                            {{ $loop->iteration }}
                        </td>
                        <td
                            class="px-5 py-3 dark:border-darkmode-300 !min-w-40 !max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]">
                            <a class="font-medium">{{ $sponsor->getName() }}</a>
                        </td>
                        <td
                            class="px-5 py-3 dark:border-darkmode-300 max-w-40 truncate border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]">
                            {{ $sponsor->address }}
                            <a class="mt-0.5 block whitespace-nowrap text-xs text-slate-500" href="">
                                {{ $sponsor->zone?->name }}</a>
                        </td>
                        <td
                            class="px-5 py-3 dark:border-darkmode-300 border-b-0 bg-white text-center first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]">
                            {{ $sponsor->file_number }}
                        </td>
                        <td
                            class="px-5 py-3 dark:border-darkmode-300 w-40 border-b-0 bg-white first:rounded-s-md last:rounded-e-md dark:bg-darkmode-600 ltr:shadow-[20px_3px_20px_#0000000b] rtl:shadow-[-20px_3px_20px_#0000000b]">
                            <div class="whitespace-nowrap">{{ $sponsor->start_date->format('Y-m-d') }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
