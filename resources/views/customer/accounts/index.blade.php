<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Accounts</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Create account button --}}
            <div class="mb-4">
                <a href="{{ route('accounts.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Open New Account
                </a>
            </div>

            {{-- Accounts list --}}
            @forelse($accounts as $account)
                <div class="bg-white p-6 rounded shadow mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm uppercase">{{ $account->type }}</p>
                            <p class="font-bold text-lg">{{ $account->account_number }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-500 text-sm">Balance</p>
                            <p class="font-bold text-2xl text-green-600">
                                ₱{{ number_format($account->balance, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                    You don't have any accounts yet. Open one above!
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>