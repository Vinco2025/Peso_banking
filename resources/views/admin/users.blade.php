<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Customers</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search Form --}}
            <form method="GET" action="{{ route('admin.users') }}" class="mb-6 flex gap-3 items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name, email, or account number..."
                    class="border-gray-300 rounded-md shadow-sm text-sm w-80">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users') }}" class="text-sm text-gray-500 hover:underline">Clear</a>
                @endif
            </form>

            <div class="bg-white shadow-sm rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Accounts</th>
                            <th class="px-4 py-3">Total Balance</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @foreach ($user->accounts as $account)
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-xs">{{ $account->account_number }}</span>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold
                                                {{ $account->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ ucfirst($account->status) }}
                                            </span>
                                            @if ($account->status === 'active')
                                                <button type="button"
                                                    onclick="document.getElementById('deactivate-{{ $account->id }}').submit()"
                                                    class="bg-red-500 text-white px-2 py-0.5 rounded text-xs hover:bg-red-600">
                                                    Deactivate
                                                </button>
                                                <form id="deactivate-{{ $account->id }}" method="POST"
                                                    action="{{ route('admin.accounts.deactivate', $account) }}" class="hidden">
                                                    @csrf
                                                </form>
                                            @else
                                                <button type="button"
                                                    onclick="document.getElementById('activate-account-{{ $account->id }}').submit()"
                                                    class="bg-green-500 text-white px-2 py-0.5 rounded text-xs hover:bg-green-600">
                                                    Activate
                                                </button>
                                                <form id="activate-account-{{ $account->id }}" method="POST"
                                                    action="{{ route('admin.accounts.activate', $account) }}" class="hidden">
                                                    @csrf
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.user.transactions', $user) }}"
                                                class="mt-1 inline-block bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                                View Transactions
                                            </a>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 font-semibold">
                                    ₱{{ number_format($user->accounts->sum('balance'), 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($user->status === 'active')
                                        <button type="button"
                                            onclick="document.getElementById('suspend-{{ $user->id }}').submit()"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                            Suspend
                                        </button>
                                        <form id="suspend-{{ $user->id }}" method="POST"
                                            action="{{ route('admin.users.suspend', $user) }}" class="hidden">
                                            @csrf
                                        </form>
                                    @else
                                        <button type="button"
                                            onclick="document.getElementById('activate-{{ $user->id }}').submit()"
                                            class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                            Activate
                                        </button>
                                        <form id="activate-{{ $user->id }}" method="POST"
                                            action="{{ route('admin.users.activate', $user) }}" class="hidden">
                                            @csrf
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <p class="text-lg font-semibold text-gray-500">No customers found</p>
                                        <p class="text-sm mt-1">Try a different search term.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>