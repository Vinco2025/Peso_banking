<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if (auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                            Customers
                        </x-nav-link>
                        <x-nav-link :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')">
                            Transactions
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('accounts.index')" :active="request()->routeIs('accounts.*')">
                            Accounts
                        </x-nav-link>
                        <x-nav-link :href="route('transaction.history')" :active="request()->routeIs('transaction.history')">
                            History
                        </x-nav-link>
                        <x-nav-link :href="route('deposit.form')" :active="request()->routeIs('deposit.form')">
                            Deposit
                        </x-nav-link>
                        <x-nav-link :href="route('withdraw.form')" :active="request()->routeIs('withdraw.form')">
                            Withdraw
                        </x-nav-link>
                        <x-nav-link :href="route('transfer.form')" :active="request()->routeIs('transfer.form')">
                            Transfer
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side: User + Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>

                <!-- Always visible logout button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-3 py-1.5 rounded text-sm hover:bg-red-600 transition">
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if (auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                    Customers
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')">
                    Transactions
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('accounts.index')" :active="request()->routeIs('accounts.*')">
                    Accounts
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transaction.history')" :active="request()->routeIs('transaction.history')">
                    History
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('deposit.form')" :active="request()->routeIs('deposit.form')">
                    Deposit
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('withdraw.form')" :active="request()->routeIs('withdraw.form')">
                    Withdraw
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transfer.form')" :active="request()->routeIs('transfer.form')">
                    Transfer
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Logout -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 mb-3">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>