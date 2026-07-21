<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-xl text-gray-900">Dashboard</h2>
                <p class="text-sm text-gray-500 mt-0.5">Welcome back, {{ auth()->user()->name }}! 👋</p>
            </div>
            <a href="{{ route('accounts.create') }}"
                class="bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-800 transition">
                + New Account
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Total Balance Banner --}}
            <div class="bg-gradient-to-br from-green-900 via-green-800 to-green-700 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.07),transparent_60%)] pointer-events-none"></div>
                <p class="text-green-200 text-sm font-medium uppercase tracking-widest mb-2">Total Balance</p>
                <p class="text-5xl font-bold tracking-tight mb-4">
                    ₱{{ number_format(auth()->user()->accounts->sum('balance'), 2) }}
                </p>
                <div class="flex items-center gap-2 text-green-200 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    {{ auth()->user()->accounts->count() }} {{ Str::plural('account', auth()->user()->accounts->count()) }}
                </div>
            </div>

            {{-- Quick Actions --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('deposit.form') }}"
                        class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col items-center gap-3 hover:border-green-400 hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 transition">
                            <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Deposit</span>
                    </a>

                    <a href="{{ route('withdraw.form') }}"
                        class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col items-center gap-3 hover:border-red-300 hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center group-hover:bg-red-100 transition">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Withdraw</span>
                    </a>

                    <a href="{{ route('transfer.form') }}"
                        class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col items-center gap-3 hover:border-blue-300 hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Transfer</span>
                    </a>

                    <a href="{{ route('transaction.history') }}"
                        class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col items-center gap-3 hover:border-gray-400 hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-gray-200 transition">
                            <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">History</span>
                    </a>
                </div>
            </div>

            {{-- Accounts --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">My Accounts</h3>
                @forelse(auth()->user()->accounts as $account)
                    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-3 flex justify-between items-center hover:border-green-300 hover:shadow-sm transition">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $account->account_number }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-gray-400">Savings Account</span>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        {{ $account->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                        {{ ucfirst($account->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">₱{{ number_format($account->balance, 2) }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">Available Balance</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-dashed border-gray-300 rounded-xl p-10 text-center">
                        <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium mb-1">No accounts yet</p>
                        <p class="text-gray-400 text-sm mb-4">Open your first account to get started.</p>
                        <a href="{{ route('accounts.create') }}"
                            class="bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-800 transition">
                            Open an Account
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>