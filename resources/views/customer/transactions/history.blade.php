<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Transaction History</h2>
                <p class="text-sm text-gray-500 mt-1">View and filter your past transactions</p>
            </div>
            <a href="{{ route('transactions.export-pdf') }}"
               class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('transaction.history') }}"
                  class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex flex-wrap gap-4 items-end">

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
                    <select name="type"
                            class="border border-gray-200 rounded-lg text-sm px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        <option value="">All Types</option>
                        <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                        <option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="border border-gray-200 rounded-lg text-sm px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="border border-gray-200 rounded-lg text-sm px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                </div>

                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    Filter
                </button>

                @if(request('type') || request('date_from') || request('date_to'))
                    <a href="{{ route('transaction.history') }}"
                       class="text-sm text-gray-400 hover:text-gray-600 transition self-center">
                        Clear filters
                    </a>
                @endif

            </form>

            {{-- Transactions Table --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                @if(session('success'))
                    <div class="flex items-center gap-3 bg-green-50 border-b border-green-100 text-green-800 text-sm px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($transactions->isEmpty())
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-1">No transactions found</h3>
                        <p class="text-sm text-gray-400 mb-6">Try adjusting your filters or make your first transaction.</p>
                        <a href="{{ route('deposit.form') }}"
                           class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow transition">
                            Make your first deposit
                        </a>
                    </div>

                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">From Account</th>
                                <th class="px-6 py-4">To Account</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Receipt</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($transactions as $tx)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                        {{ $tx->created_at->format('M d, Y') }}
                                        <span class="block text-xs text-gray-400">{{ $tx->created_at->format('h:i A') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                            {{ $tx->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $tx->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $tx->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ ucfirst($tx->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-600 text-xs">
                                        {{ $tx->fromAccount->account_number ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-600 text-xs">
                                        {{ $tx->toAccount->account_number ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        ₱{{ number_format($tx->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('transaction.receipt', $tx) }}"
                                           class="inline-flex items-center gap-1 text-xs font-medium text-green-700 hover:text-green-900 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>