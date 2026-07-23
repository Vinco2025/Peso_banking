<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Admin Dashboard</h2>
            <p class="text-sm text-gray-500 mt-1">Overview of Peso Bank's current activity</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Total Customers --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-500">Total Customers</p>
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-400 mt-1">Registered users</p>
                </div>

                {{-- Total Accounts --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-500">Total Accounts</p>
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalAccounts }}</p>
                    <p class="text-xs text-gray-400 mt-1">Active bank accounts</p>
                </div>

                {{-- Total Transactions --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-500">Total Transactions</p>
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalTransactions }}</p>
                    <p class="text-xs text-gray-400 mt-1">All time transactions</p>
                </div>

                {{-- Total Balance --}}
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-500">Total Balance</p>
                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">₱{{ number_format($totalBalance, 2) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Across all accounts</p>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <a href="{{ route('admin.users') }}"
                       class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition group">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shrink-0 group-hover:bg-green-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">View All Customers</p>
                            <p class="text-xs text-gray-400 mt-0.5">Manage users and account status</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('admin.transactions') }}"
                       class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition group">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shrink-0 group-hover:bg-blue-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">View All Transactions</p>
                            <p class="text-xs text-gray-400 mt-0.5">Browse and monitor all activity</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>