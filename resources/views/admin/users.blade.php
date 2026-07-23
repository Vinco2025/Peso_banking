<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">All Customers</h2>
            <p class="text-sm text-gray-500 mt-1">Manage customer accounts and status</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Search Form --}}
            <form method="GET" action="{{ route('admin.users') }}"
                  class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex flex-wrap gap-3 items-center">
                <div class="relative flex-1 min-w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, email, or account number..."
                        class="w-full border border-gray-200 rounded-lg pl-9 pr-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                </div>
                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users') }}"
                       class="text-sm text-gray-400 hover:text-gray-600 transition">
                        Clear
                    </a>
                @endif
            </form>

            {{-- Users Table --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                @if(session('success'))
                    <div class="flex items-center gap-3 bg-green-50 border-b border-green-100 text-green-800 text-sm px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @forelse($users as $user)
                    <div class="p-6 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition">
                        <div class="flex flex-wrap gap-6 items-start justify-between">

                            {{-- User info --}}
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>

                            {{-- Total balance --}}
                            <div class="text-right">
                                <p class="text-xs text-gray-400 mb-0.5">Total Balance</p>
                                <p class="text-lg font-bold text-green-700">₱{{ number_format($user->accounts->sum('balance'), 2) }}</p>
                            </div>

                            {{-- User status + action --}}
                            <div class="flex items-center gap-3">
                                @if($user->status === 'active')
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">● Active</span>
                                    <button type="button"
                                        onclick="document.getElementById('suspend-{{ $user->id }}').submit()"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow transition">
                                        Suspend
                                    </button>
                                    <form id="suspend-{{ $user->id }}" method="POST"
                                        action="{{ route('admin.users.suspend', $user) }}" class="hidden">
                                        @csrf
                                    </form>
                                @else
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-red-100 text-red-600">● Suspended</span>
                                    <button type="button"
                                        onclick="document.getElementById('activate-{{ $user->id }}').submit()"
                                        class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow transition">
                                        Activate
                                    </button>
                                    <form id="activate-{{ $user->id }}" method="POST"
                                        action="{{ route('admin.users.activate', $user) }}" class="hidden">
                                        @csrf
                                    </form>
                                @endif

                                <a href="{{ route('admin.user.transactions', $user) }}"
                                   class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    Transactions
                                </a>
                            </div>

                        </div>

                        {{-- Accounts --}}
                        @if($user->accounts->count() > 0)
                            <div class="mt-4 flex flex-wrap gap-3">
                                @foreach($user->accounts as $account)
                                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 rounded-xl px-4 py-2">
                                        <span class="font-mono text-xs text-gray-600">{{ $account->account_number }}</span>
                                        @if($account->status === 'active')
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">Active</span>
                                            <button type="button"
                                                onclick="document.getElementById('deactivate-{{ $account->id }}').submit()"
                                                class="text-xs text-red-500 hover:text-red-700 font-medium transition">
                                                Deactivate
                                            </button>
                                            <form id="deactivate-{{ $account->id }}" method="POST"
                                                action="{{ route('admin.accounts.deactivate', $account) }}" class="hidden">
                                                @csrf
                                            </form>
                                        @else
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600">Inactive</span>
                                            <button type="button"
                                                onclick="document.getElementById('activate-account-{{ $account->id }}').submit()"
                                                class="text-xs text-green-600 hover:text-green-800 font-medium transition">
                                                Activate
                                            </button>
                                            <form id="activate-account-{{ $account->id }}" method="POST"
                                                action="{{ route('admin.accounts.activate', $account) }}" class="hidden">
                                                @csrf
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-3 text-xs text-gray-400">No accounts yet.</p>
                        @endif

                    </div>

                @empty
                    <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-1">No customers found</h3>
                        <p class="text-sm text-gray-400">Try a different search term.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>