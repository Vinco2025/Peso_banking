<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Transaction Receipt</h2>
                <p class="text-sm text-gray-500 mt-1">Official proof of transaction</p>
            </div>
            <a href="{{ route('transaction.history') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to History
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                {{-- Colored top banner --}}
                <div class="h-2
                    {{ $transaction->type === 'deposit' ? 'bg-green-500' : '' }}
                    {{ $transaction->type === 'withdrawal' ? 'bg-red-500' : '' }}
                    {{ $transaction->type === 'transfer' ? 'bg-blue-500' : '' }}">
                </div>

                <div class="p-8">

                    {{-- Icon + amount --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4
                            {{ $transaction->type === 'deposit' ? 'bg-green-100' : '' }}
                            {{ $transaction->type === 'withdrawal' ? 'bg-red-100' : '' }}
                            {{ $transaction->type === 'transfer' ? 'bg-blue-100' : '' }}">
                            @if($transaction->type === 'deposit')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            @elseif($transaction->type === 'withdrawal')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            @endif
                        </div>

                        <p class="text-sm font-semibold uppercase tracking-widest
                            {{ $transaction->type === 'deposit' ? 'text-green-600' : '' }}
                            {{ $transaction->type === 'withdrawal' ? 'text-red-600' : '' }}
                            {{ $transaction->type === 'transfer' ? 'text-blue-600' : '' }}">
                            {{ ucfirst($transaction->type) }}
                        </p>

                        <p class="text-4xl font-bold text-gray-900 mt-1">
                            ₱{{ number_format($transaction->amount, 2) }}
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            {{ $transaction->created_at->format('F d, Y — h:i A') }}
                        </p>
                    </div>

                    {{-- Divider with label --}}
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-dashed border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-3 text-xs text-gray-400 uppercase tracking-wide">Details</span>
                        </div>
                    </div>

                    {{-- Transaction details --}}
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Transaction ID</span>
                            <span class="font-mono font-medium text-gray-800">#{{ $transaction->id }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-400">Status</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                Completed
                            </span>
                        </div>

                        @if($transaction->fromAccount)
                            <div class="flex justify-between">
                                <span class="text-gray-400">From Account</span>
                                <span class="font-mono font-medium text-gray-800">{{ $transaction->fromAccount->account_number }}</span>
                            </div>
                        @endif

                        @if($transaction->toAccount)
                            <div class="flex justify-between">
                                <span class="text-gray-400">To Account</span>
                                <span class="font-mono font-medium text-gray-800">{{ $transaction->toAccount->account_number }}</span>
                            </div>
                        @endif

                        @if($transaction->description)
                            <div class="flex justify-between">
                                <span class="text-gray-400">Description</span>
                                <span class="font-medium text-gray-800">{{ $transaction->description }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Footer --}}
                    <div class="mt-8 pt-6 border-t border-dashed border-gray-200 text-center">
                        <div class="flex items-center justify-center gap-2 mb-1">
                            <div class="w-5 h-5 bg-green-700 rounded flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-green-900">Peso Bank</span>
                        </div>
                        <p class="text-xs text-gray-400">Official Transaction Receipt</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>