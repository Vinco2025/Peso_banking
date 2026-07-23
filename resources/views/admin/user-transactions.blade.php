<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}'s Transactions</h2>
                <p class="text-sm text-gray-500 mt-1">Viewing all transactions for this customer</p>
            </div>
            <a href="{{ route('admin.users') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Customers
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- User Info Card --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-xl shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->name }}</p>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                </div>
                <div>
                    @if($user->status === 'active')
                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">● Active</span>
                    @else
                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-red-100 text-red-600">● Suspended</span>
                    @endif
                </div>
            </div>

            {{-- Transactions --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                @forelse($transactions as $transaction)
                    <div class="flex flex-wrap items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition">

                        {{-- Type badge --}}
                        <div class="w-24 shrink-0">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $transaction->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $transaction->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $transaction->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </div>

                        {{-- From account --}}
                        <div class="flex-1 min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">From</p>
                            <p class="font-mono text-xs font-medium text-gray-700">
                                {{ $transaction->fromAccount->account_number ?? '—' }}
                            </p>
                        </div>

                        {{-- Arrow --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>

                        {{-- To account --}}
                        <div class="flex-1 min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">To</p>
                            <p class="font-mono text-xs font-medium text-gray-700">
                                @if($transaction->type === 'transfer')
                                    {{ $transaction->toAccount->account_number ?? '—' }}
                                @else
                                    —
                                @endif
                            </p>
                        </div>

                        {{-- Amount --}}
                        <div class="text-right min-w-28">
                            <p class="text-xs text-gray-400 mb-0.5">Amount</p>
                            <p class="font-bold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</p>
                        </div>

                        {{-- Date --}}
                        <div class="text-right min-w-32">
                            <p class="text-xs text-gray-400 mb-0.5">Date</p>
                            <p class="text-xs font-medium text-gray-700">{{ $transaction->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $transaction->created_at->format('h:i A') }}</p>
                        </div>

                    </div>

                @empty
                    <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-1">No transactions found</h3>
                        <p class="text-sm text-gray-400">This customer has not made any transactions yet.</p>
                    </div>
                @endforelse

                @if($transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $transactions->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>