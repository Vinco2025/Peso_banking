<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Open New Account</h2>
                <p class="text-sm text-gray-500 mt-1">Choose an account type to get started</p>
            </div>
            <a href="{{ route('accounts.index') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Accounts
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

                {{-- Icon + title --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">New Bank Account</p>
                        <p class="text-xs text-gray-400">Your account will be created instantly</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('accounts.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Account Type</label>

                        {{-- Savings option --}}
                        <label class="flex items-center gap-4 border border-gray-200 rounded-xl p-4 mb-3 cursor-pointer hover:border-green-400 hover:bg-green-50 transition has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                            <input type="radio" name="type" value="savings" checked class="accent-green-700">
                            <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Savings Account</p>
                                <p class="text-xs text-gray-400">Great for storing and growing your money</p>
                            </div>
                        </label>

                        {{-- Checking option --}}
                        <label class="flex items-center gap-4 border border-gray-200 rounded-xl p-4 cursor-pointer hover:border-green-400 hover:bg-green-50 transition has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                            <input type="radio" name="type" value="checking" class="accent-green-700">
                            <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Checking Account</p>
                                <p class="text-xs text-gray-400">Ideal for everyday spending and transactions</p>
                            </div>
                        </label>

                        @error('type')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-green-700 hover:bg-green-800 text-white text-sm font-semibold py-3 rounded-lg shadow transition">
                        Open Account
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>