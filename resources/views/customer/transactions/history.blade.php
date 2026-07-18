<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction History
        </h2>
    </x-slot>

    <form method="GET" action="{{ route('transaction.history') }}" class="mb-6 flex gap-3 items-center">
        <select name="type" class="border-gray-300 rounded-md shadow-sm text-sm">
            <option value="">All Transactions</option>
            <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Deposit</option>
            <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
            <option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            Filter
        </button>
        @if(request('type'))
            <a href="{{ route('transaction.history') }}" class="text-sm text-gray-500 hover:underline">Clear</a>
        @endif
    </form>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                @if ($transactions->isEmpty())
                    <p class="text-gray-500">No transactions yet.</p>
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
                        <div class="mt-4">
                            {{ $transactions->appends(request()->query())->links() }}
                        </div>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>