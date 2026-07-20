<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction Receipt
            </h2>
            <a href="{{ route('transaction.history') }}"
                class="text-sm text-blue-600 hover:underline">
                &larr; Back to History
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">

                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4
                        {{ $transaction->type === 'deposit' ? 'bg-green-100' : '' }}
                        {{ $transaction->type === 'withdrawal' ? 'bg-red-100' : '' }}
                        {{ $transaction->type === 'transfer' ? 'bg-blue-100' : '' }}">
                        @if ($transaction->type === 'deposit')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        @elseif ($transaction->type === 'withdrawal')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 capitalize">{{ $transaction->type }}</h3>
                    <p class="text-3xl font-bold mt-1
                        {{ $transaction->type === 'deposit' ? 'text-green-600' : '' }}
                        {{ $transaction->type === 'withdrawal' ? 'text-red-600' : '' }}
                        {{ $transaction->type === 'transfer' ? 'text-blue-600' : '' }}">
                        ₱{{ number_format($transaction->amount, 2) }}
                    </p>
                </div>

                {{-- Details --}}
                <div class="border-t border-gray-100 divide-y divide-gray-100">
                    <div class="flex justify-between py-3 text-sm">
                        <span class="text-gray-500">Transaction ID</span>
                        <span class="font-medium text-gray-800">#{{ $transaction->id }}</span>
                    </div>
                    <div class="flex justify-between py-3 text-sm">
                        <span class="text-gray-500">Date & Time</span>
                        <span class="font-medium text-gray-800">{{ $transaction->created_at->format('F d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between py-3 text-sm">
                        <span class="text-gray-500">Type</span>
                        <span class="px-2 py-0.5 rounded text-xs font-semibold capitalize
                            {{ $transaction->type === 'deposit' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $transaction->type === 'withdrawal' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $transaction->type === 'transfer' ? 'bg-blue-100 text-blue-700' : '' }}">
                            {{ $transaction->type }}
                        </span>
                    </div>
                    @if ($transaction->fromAccount)
                        <div class="flex justify-between py-3 text-sm">
                            <span class="text-gray-500">From Account</span>
                            <span class="font-medium text-gray-800">{{ $transaction->fromAccount->account_number }}</span>
                        </div>
                    @endif
                    @if ($transaction->toAccount)
                        <div class="flex justify-between py-3 text-sm">
                            <span class="text-gray-500">To Account</span>
                            <span class="font-medium text-gray-800">{{ $transaction->toAccount->account_number }}</span>
                        </div>
                    @endif
                    @if ($transaction->description)
                        <div class="flex justify-between py-3 text-sm">
                            <span class="text-gray-500">Description</span>
                            <span class="font-medium text-gray-800">{{ $transaction->description }}</span>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="mt-8 text-center text-xs text-gray-400">
                    Peso Bank — Official Transaction Receipt
                </div>

            </div>
        </div>
    </div>
</x-app-layout>