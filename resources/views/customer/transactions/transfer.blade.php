<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transfer Funds
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transfer.submit') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">From Account</label>
                        <select name="from_account_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->account_number }} — ₱{{ number_format($account->balance, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">To Account Number</label>
                        <input type="text" name="to_account_number"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. ACC-XXXXXXXX" value="{{ old('to_account_number') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" name="amount" step="0.01" min="0.01"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('amount') }}">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Transfer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>