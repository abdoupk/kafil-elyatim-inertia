<x-table>
    <x-slot name="thead">
        <x-th class=" py-0.5 ">
            <span> #</span>
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('receiving_member') }}
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('the_amount') }}
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('validation.attributes.specification') }}
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('the date') }}
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('validation.attributes.created_at') }}
        </x-th>

        <x-th class=" py-0.5 ">
            {{ __('created_by') }}
        </x-th>
    </x-slot>

    <x-slot name="tbody">
        @foreach ($transactions as $transaction)
            <tr>
                <x-td class=" py-0.5  text-center">
                    {{ $loop->iteration }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ $transaction->receiver?->getName() }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ formatCurrency($transaction->amount) }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ __($transaction->specification) }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ $transaction->date->translatedFormat('j F Y H:i A') }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ $transaction->created_at->translatedFormat('j F Y H:i A') }}
                </x-td>

                <x-td class=" py-0.5  text-center">
                    {{ $transaction->creator->getName() }}
                </x-td>
            </tr>
        @endforeach

        <tr>
            <x-td class=" py-0.5  text-center font-semibold" colspan="2">
                {{ __('the_total_amount') }}
            </x-td>

            <x-td class=" py-0.5  text-center">
                {{ formatCurrency($transactions->sum('amount')) }}
            </x-td>
        </tr>
    </x-slot>
</x-table>
