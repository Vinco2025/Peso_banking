<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-sm text-gray-500">Total Customers</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-sm text-gray-500">Total Accounts</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalAccounts }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-sm text-gray-500">Total Transactions</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalTransactions }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-sm text-gray-500">Total Balance</p>
                    <p class="text-3xl font-bold text-yellow-600">₱{{ number_format($totalBalance, 2) }}</p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="flex gap-4">
                <a href="{{ route('admin.users') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    View All Users
                </a>
                <a href="{{ route('admin.transactions') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue    -700">
                    View All Transactions
                </a>
            </div>

        </div>
    </div>
</x-app-layout>