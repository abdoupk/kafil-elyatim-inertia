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
                    {{ __('receiving_member') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('the_amount') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('validation.attributes.specification') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('the date') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('validation.attributes.created_at') }}
                </th>

                <th class="whitespace-nowrap font-medium px-3 py-0.5 border border-black">
                    {{ __('created_by') }}
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($transactions as $transaction)
                <tr>
                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $transaction->receiver?->getName() }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ formatCurrency($transaction->amount) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ __($transaction->specification) }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $transaction->date->translatedFormat('j F Y H:i A') }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $transaction->created_at->translatedFormat('j F Y H:i A') }}
                    </td>

                    <td class="px-2 py-0.5 border text-center border-black">
                        {{ $transaction->creator->getName() }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td class="px-2 py-0.5 border text-center border-black font-semibold" colspan="2">
                    {{ __('the_total_amount') }}
                </td>

                <td class="px-2 py-0.5 border text-center border-black">
                    {{ formatCurrency($transactions->sum('amount')) }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
