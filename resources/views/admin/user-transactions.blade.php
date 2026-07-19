<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transactions — {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.users') }}" 
                class="text-blue-600 hover:underline text-sm">&larr; Back to Users</a>
            </div>

            {{-- User Info Card --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-semibold">Status:</span> 
                    <span class="{{ $user->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </p>
            </div>

            {{-- Transactions Table --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Account</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Details</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $transaction->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        {{ $transaction->type === 'deposit' ? 'bg-green-100 text-green-700' : 
                                        ($transaction->type === 'withdrawal' ? 'bg-red-100 text-red-700' : 
                                        'bg-blue-100 text-blue-700') }}">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $transaction->fromAccount->account_number ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    ₱{{ number_format($transaction->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    @if ($transaction->type === 'transfer')
                                        To: {{ $transaction->toAccount->account_number ?? 'N/A' }}
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    No transactions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if ($transactions->hasPages())
                    <div class="px-6 py-4 border-t">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>