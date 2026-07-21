<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction History
            </h2>
            <a href="{{ route('transactions.export-pdf') }}"
                class="bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600">
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('transaction.history') }}" class="mb-6 bg-white shadow-sm rounded-lg p-4 flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
                    <select name="type" class="border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">All Types</option>
                        <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                        <option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="border-gray-300 rounded-md shadow-sm text-sm">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="border-gray-300 rounded-md shadow-sm text-sm">
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                    Filter
                </button>

                @if(request('type') || request('date_from') || request('date_to'))
                    <a href="{{ route('transaction.history') }}" class="text-sm text-gray-500 hover:underline self-end mb-2">
                        Clear
                    </a>
                @endif
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                @if ($transactions->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <p class="text-lg font-semibold text-gray-500">No transactions found</p>
                        <p class="text-sm mt-1">Try adjusting your filters or make your first transaction.</p>
                        <a href="{{ route('deposit.form') }}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                            Make your first deposit
                        </a>
                    </div>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">From Account</th>
                                <th class="px-4 py-3">To Account</th>
                                <th class="px-4 py-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($transactions as $tx)
                            <th class="px-4 py-3">Receipt</th>
                            <td class="px-4 py-3">
                                <a href="{{ route('transaction.receipt', $tx) }}"
                                    class="text-green-600 hover:underline text-xs">
                                    View
                                </a>
                            </td>
                                <tr>
                                    <td class="px-4 py-3">{{ $tx->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="px-4 py-3 capitalize">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            {{ $tx->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $tx->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $tx->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ $tx->type }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ $tx->fromAccount->account_number ?? '—' }}</td>
                                    <td class="px-4 py-3">{{ $tx->toAccount->account_number ?? '—' }}</td>
                                    <td class="px-4 py-3 font-semibold">₱{{ number_format($tx->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>