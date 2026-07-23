<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">All Transactions</h2>
            <p class="text-sm text-gray-500 mt-1">Monitor all customer transaction activity</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('admin.transactions') }}"
                  class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex flex-wrap gap-4 items-center">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Transaction Type</label>
                    <select name="type"
                            class="border border-gray-200 rounded-lg text-sm px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        <option value="">All Transactions</option>
                        <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                        <option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                        Filter
                    </button>
                    @if(request('type'))
                        <a href="{{ route('admin.transactions') }}"
                           class="text-sm text-gray-400 hover:text-gray-600 transition">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            {{-- Transactions Table --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                @forelse($transactions as $tx)
                    <div class="flex flex-wrap items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition">

                        {{-- Type badge --}}
                        <div class="w-24 shrink-0">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $tx->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $tx->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $tx->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                                {{ ucfirst($tx->type) }}
                            </span>
                        </div>

                        {{-- From --}}
                        <div class="flex-1 min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">From</p>
                            <p class="font-mono text-xs font-medium text-gray-700">{{ $tx->fromAccount->account_number ?? '—' }}</p>
                            <p class="text-xs text-gray-400">{{ $tx->fromAccount->user->name ?? '' }}</p>
                        </div>

                        {{-- Arrow --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>

                        {{-- To --}}
                        <div class="flex-1 min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">To</p>
                            <p class="font-mono text-xs font-medium text-gray-700">{{ $tx->toAccount->account_number ?? '—' }}</p>
                            <p class="text-xs text-gray-400">{{ $tx->toAccount->user->name ?? '' }}</p>
                        </div>

                        {{-- Amount --}}
                        <div class="text-right min-w-28">
                            <p class="text-xs text-gray-400 mb-0.5">Amount</p>
                            <p class="font-bold text-gray-900">₱{{ number_format($tx->amount, 2) }}</p>
                        </div>

                        {{-- Date --}}
                        <div class="text-right min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">Date</p>
                            <p class="text-xs font-medium text-gray-700">{{ $tx->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $tx->created_at->format('h:i A') }}</p>
                        </div>

                    </div>

                @empty
                    <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-1">No transactions yet</h3>
                        <p class="text-sm text-gray-400">Transactions will appear here once customers start transacting.</p>
                    </div>
                @endforelse

                @if($transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>