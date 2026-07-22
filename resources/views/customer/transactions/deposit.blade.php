<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Deposit Money</h2>
            <p class="text-sm text-gray-500 mt-1">Add funds to one of your accounts</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

                {{-- Icon + title --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">New Deposit</p>
                        <p class="text-xs text-gray-400">Funds will be credited immediately</p>
                    </div>
                </div>

                {{-- Success message --}}
                @if(session('success'))
                    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-lg mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('deposit') }}">
                    @csrf

                    {{-- Account selector --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Account</label>
                        <select name="account_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->account_number }} — ₱{{ number_format($account->balance, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('account_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">₱</span>
                            <input type="number" name="amount" min="1" step="0.01"
                                value="{{ old('amount') }}"
                                class="w-full border border-gray-200 rounded-lg pl-7 pr-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="0.00">
                        </div>
                        @error('amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                            <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" name="description"
                            value="{{ old('description') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="e.g. Salary, Allowance">
                    </div>

                    <button type="submit"
                            class="w-full bg-green-700 hover:bg-green-800 text-white text-sm font-semibold py-3 rounded-lg shadow transition">
                        Confirm Deposit
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>