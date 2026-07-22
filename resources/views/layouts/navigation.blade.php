<nav x-data="{ open: false }" class="bg-green-900 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white font-bold text-lg tracking-tight shrink-0">
                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    Peso Bank
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden sm:flex sm:items-center sm:ms-10 gap-1">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('dashboard') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                        Dashboard
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.users') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('admin.users') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Customers
                        </a>
                        <a href="{{ route('admin.transactions') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('admin.transactions') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Transactions
                        </a>
                    @else
                        <a href="{{ route('accounts.index') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('accounts.*') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Accounts
                        </a>
                        <a href="{{ route('transaction.history') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('transaction.history') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            History
                        </a>
                        <a href="{{ route('deposit.form') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('deposit.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Deposit
                        </a>
                        <a href="{{ route('withdraw.form') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('withdraw.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Withdraw
                        </a>
                        <a href="{{ route('transfer.form') }}"
                            class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('transfer.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-800 hover:text-white' }}">
                            Transfer
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right Side --}}
            <div class="hidden sm:flex sm:items-center gap-3">

                {{-- Avatar dropdown --}}
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center gap-2 hover:bg-green-800 px-3 py-1.5 rounded-lg transition">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-green-100 text-sm font-medium">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="dropdownOpen"
                        @click.outside="dropdownOpen = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edit Profile
                        </a>

                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-200 hover:text-white hover:bg-green-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-green-800 border-t border-green-700">
        <div class="pt-2 pb-3 px-4 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('dashboard') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                Dashboard
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.users') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('admin.users') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Customers
                </a>
                <a href="{{ route('admin.transactions') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('admin.transactions') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Transactions
                </a>
            @else
                <a href="{{ route('accounts.index') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('accounts.*') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Accounts
                </a>
                <a href="{{ route('transaction.history') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('transaction.history') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    History
                </a>
                <a href="{{ route('deposit.form') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('deposit.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Deposit
                </a>
                <a href="{{ route('withdraw.form') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('withdraw.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Withdraw
                </a>
                <a href="{{ route('transfer.form') }}"
                    class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('transfer.form') ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700 hover:text-white' }}">
                    Transfer
                </a>
            @endif
        </div>

        {{-- Mobile User + Logout --}}
        <div class="border-t border-green-700 px-4 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-white font-semibold text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-green-300 text-xs">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700 hover:text-white transition mb-1">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700 hover:text-white transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>