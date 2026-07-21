<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peso Bank — Your Trusted Banking Partner</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-50 font-sans">

    {{-- NAV --}}
    <nav class="bg-green-900 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 text-white font-bold text-xl tracking-tight">
                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                Peso Bank
            </a>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-white text-green-900 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-100 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white border border-white/40 px-5 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition">
                        Log In
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-white text-green-900 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-100 transition">
                            Open Account
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white py-28 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.04),transparent_70%)] pointer-events-none"></div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl sm:text-5xl font-bold leading-tight mb-5 tracking-tight">
                Banking Made <span class="text-green-300">Simple,</span><br>Secure & Smart
            </h1>
            <p class="text-white/75 text-lg max-w-xl mx-auto mb-10 leading-relaxed">
                Manage your money effortlessly. Deposit, withdraw, and transfer funds anytime — all in one place.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-white text-green-900 px-8 py-3.5 rounded-lg font-bold text-base hover:bg-green-100 transition shadow-lg hover:-translate-y-0.5 transform">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="bg-white text-green-900 px-8 py-3.5 rounded-lg font-bold text-base hover:bg-green-100 transition shadow-lg hover:-translate-y-0.5 transform">
                        Open a Free Account
                    </a>
                    <a href="{{ route('login') }}"
                        class="border-2 border-white/40 text-white px-8 py-3.5 rounded-lg font-semibold text-base hover:bg-white/10 hover:border-white transition">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <div class="bg-white border-b border-gray-200 py-8 px-6">
        <div class="max-w-4xl mx-auto flex flex-wrap justify-around gap-6 text-center">
            <div>
                <div class="text-3xl font-bold text-green-800">₱0 Fees</div>
                <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">No hidden charges</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-800">24/7</div>
                <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">Online access</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-800">100%</div>
                <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">Secure transactions</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-800">Instant</div>
                <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">Fund transfers</div>
            </div>
        </div>
    </div>

    {{-- FEATURES --}}
    <section class="py-20 px-6 max-w-6xl mx-auto">
        <p class="text-center text-green-700 text-xs font-bold uppercase tracking-widest mb-3">What We Offer</p>
        <h2 class="text-center text-3xl font-bold text-gray-900 mb-3">Everything You Need to Manage Your Money</h2>
        <p class="text-center text-gray-500 max-w-md mx-auto mb-14 leading-relaxed">Simple, powerful banking tools designed for everyday use.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Easy Deposits</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Add funds to your account instantly. Track every deposit with a detailed transaction history.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Quick Withdrawals</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Withdraw your money whenever you need it. Real-time balance updates keep you informed.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Instant Transfers</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Send money to any Peso Bank account in seconds. Safe, fast, and always confirmed.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v8m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Transaction History</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Filter and search your full transaction history. Export to PDF anytime you need a record.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Secure & Protected</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Your account is protected with role-based access and account status controls.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Multiple Accounts</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Open and manage multiple bank accounts under one profile with total control.</p>
            </div>

        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="bg-white py-20 px-6">
        <p class="text-center text-green-700 text-xs font-bold uppercase tracking-widest mb-3">Get Started</p>
        <h2 class="text-center text-3xl font-bold text-gray-900 mb-3">How It Works</h2>
        <p class="text-center text-gray-500 max-w-md mx-auto mb-14 leading-relaxed">Up and running in just a few simple steps.</p>

        <div class="max-w-lg mx-auto flex flex-col gap-0">

            @foreach ([
                ['1', 'Create an Account', 'Register with your name and email. It\'s free and takes less than a minute.'],
                ['2', 'Open a Bank Account', 'Once logged in, open your first bank account. Your unique account number is generated instantly.'],
                ['3', 'Make Your First Deposit', 'Fund your account and start managing your money right away.'],
                ['4', 'Transfer, Withdraw & Track', 'Send money, withdraw funds, and monitor every transaction in your history.'],
            ] as $step)
            <div class="flex gap-5 items-start {{ !$loop->last ? 'pb-10' : '' }} relative">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 bg-green-900 text-white rounded-full flex items-center justify-center font-bold text-sm shrink-0 z-10">
                        {{ $step[0] }}
                    </div>
                    @if (!$loop->last)
                        <div class="w-0.5 bg-green-200 flex-1 mt-1" style="min-height: 40px;"></div>
                    @endif
                </div>
                <div class="pt-1.5">
                    <h3 class="font-bold text-gray-900 mb-1">{{ $step[1] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $step[2] }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-green-900 to-green-700 text-white text-center py-20 px-6">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4">Ready to Start Banking Smarter?</h2>
        <p class="text-white/75 text-lg max-w-md mx-auto mb-10">Join Peso Bank today and experience modern, hassle-free banking.</p>
        @auth
            <a href="{{ url('/dashboard') }}"
                class="bg-white text-green-900 px-8 py-3.5 rounded-lg font-bold text-base hover:bg-green-100 transition shadow-lg">
                Go to Dashboard
            </a>
        @else
            <a href="{{ route('register') }}"
                class="bg-white text-green-900 px-8 py-3.5 rounded-lg font-bold text-base hover:bg-green-100 transition shadow-lg">
                Open a Free Account
            </a>
        @endauth
    </section>

    {{-- FOOTER --}}
    <footer class="bg-green-950 text-white/40 text-center py-6 text-sm">
        &copy; {{ date('Y') }} <span class="text-green-400">Peso Bank</span>. All rights reserved.
    </footer>

</body>
</html>