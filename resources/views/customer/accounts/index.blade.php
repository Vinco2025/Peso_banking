<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">My Accounts</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your Peso Bank accounts</p>
            </div>
            <a href="{{ route('accounts.create') }}"
               class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Open New Account
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success message --}}
            @if(session('success'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Accounts list --}}
            @forelse($accounts as $account)
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition p-6">
                    <div class="flex items-start justify-between">

                        {{-- Left: type, number, status --}}
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 10h18M3 6h18M3 14h18M3 18h18" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-semibold uppercase tracking-widest text-green-700 bg-green-50 border border-green-200 px-2 py-0.5 rounded-full">
                                        {{ $account->type }}
                                    </span>
                                    @if($account->status === 'active')
                                        <span class="text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full">
                                            ● Active
                                        </span>
                                    @else
                                        <span class="text-xs font-medium text-red-600 bg-red-50 border border-red-200 px-2 py-0.5 rounded-full">
                                            ● Inactive
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 font-mono tracking-wide">{{ $account->account_number }}</p>
                            </div>
                        </div>

                        {{-- Right: balance --}}
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Balance</p>
                            <p class="text-3xl font-bold text-green-700">₱{{ number_format($account->balance, 2) }}</p>
                        </div>

                    </div>
                </div>
            @empty
                {{-- Empty state --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-12 flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-green-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 10h18M3 6h18M3 14h6m-6 4h6m6-4h6m-6 4h6" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">No accounts yet</h3>
                    <p class="text-sm text-gray-400 mb-6">Open your first account to start managing your finances.</p>
                    <a href="{{ route('accounts.create') }}"
                       class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Open New Account
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>