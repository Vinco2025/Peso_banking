<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Customer Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <p class="mb-6 text-gray-600">Welcome back, {{ auth()->user()->name }}! 👋</p>

            {{-- Account summary cards --}}
            @forelse(auth()->user()->accounts as $account)
                <div class="bg-white p-6 rounded shadow mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm uppercase">{{ $account->type }}</p>
                        <p class="font-bold">{{ $account->account_number }}</p>
                    </div>
                    <p class="text-green-600 font-bold text-xl">
                        ₱{{ number_format($account->balance, 2) }}
                    </p>
                </div>
            @empty
                <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                    No accounts yet.
                    <a href="{{ route('accounts.create') }}" class="text-blue-600 underline">
                        Open one now!
                    </a>
                </div>
            @endforelse

            {{-- Quick actions --}}
            <div class="flex gap-4 mb-6">
                <a href="{{ route('deposit.form') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    💰 Deposit
                </a>
                <a href="{{ route('withdraw.form') }}"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    💸 Withdraw
                </a>
                <a href="{{ route('transfer.form') }}"
                    class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                        Transfer
                </a>
            </div>

        </div>
    </div>
</x-app-layout>