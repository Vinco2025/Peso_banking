<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Transactions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- Filter --}}
                <form method="GET" action="{{ route('admin.transactions') }}" class="mb-6 flex gap-3 items-center">
                    <select name="type" class="border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">All Transactions</option>
                        <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                        <option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                        Filter
                    </button>
                    @if(request('type'))
                        <a href="{{ route('admin.transactions') }}" class="text-sm text-gray-500 hover:underline">Clear</a>
                    @endif
                </form>

                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">From</th>
                            <th class="px-4 py-3">To</th>
                            <th class="px-4 py-3">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($transactions as $tx)
                            <tr>
                                <td class="px-4 py-3">{{ $tx->created_at->format('M d, Y h:i A') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        {{ $tx->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $tx->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $tx->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                                        {{ $tx->type }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $tx->fromAccount->account_number ?? '—' }}<br>
                                    <span class="text-xs text-gray-400">{{ $tx->fromAccount->user->name ?? '' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ $tx->toAccount->account_number ?? '—' }}<br>
                                    <span class="text-xs text-gray-400">{{ $tx->toAccount->user->name ?? '' }}</span>
                                </td>
                                <td class="px-4 py-3 font-semibold">₱{{ number_format($tx->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        <p class="text-lg font-semibold text-gray-500">No transactions yet</p>
                                        <p class="text-sm mt-1">Transactions will appear here once customers start transacting.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($transactions->hasPages())
                    <div class="mt-4">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>