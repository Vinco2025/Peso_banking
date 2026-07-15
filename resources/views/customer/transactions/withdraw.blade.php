<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Withdraw Money</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('withdraw') }}">
                @csrf

                {{-- Account selector --}}
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Select Account</label>
                    <select name="account_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">
                                {{ $account->account_number }}
                                (₱{{ number_format($account->balance, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('account_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Amount (₱)</label>
                    <input type="number" name="amount" min="1" step="0.01"
                        value="{{ old('amount') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                        placeholder="Enter amount">
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Description (optional)</label>
                    <input type="text" name="description"
                        value="{{ old('description') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring"
                        placeholder="e.g. Bills, Groceries">
                </div>

                <button type="submit"
                        class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
                    Withdraw
                </button>
            </form>

        </div>
    </div>
</x-app-layout>