<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Peso Bank</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-green-50 font-sans text-gray-900">
    <nav class="bg-green-900 shadow-lg">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
            <a href="/" class="flex items-center gap-2 text-xl font-bold tracking-tight text-white">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-600">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                Peso Bank
            </a>
            <a href="{{ url('/') }}" class="text-sm font-medium text-white/80 transition hover:text-white">
                Back to Home
            </a>
        </div>
    </nav>

    <main class="flex min-h-[calc(100vh-4rem)] items-center justify-center px-6 py-16">
        <div class="grid w-full max-w-6xl items-center gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="hidden lg:block">
                <div class="max-w-xl rounded-3xl border border-green-100 bg-white/70 p-8 shadow-sm backdrop-blur">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-green-700">Secure Access</p>
                    <h1 class="mb-4 text-4xl font-bold leading-tight text-gray-900">
                        Welcome back to your <span class="text-green-700">digital banking space</span>
                    </h1>
                    <p class="text-lg leading-relaxed text-gray-600">
                        Sign in to manage your accounts, transfer funds, and keep your finances in sync anytime.
                    </p>
                </div>
            </div>

            <div class="rounded-3xl border border-green-100 bg-white p-8 shadow-2xl shadow-green-100 sm:p-10">
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100">
                        <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm3-10V7a3 3 0 016 0v4h-6z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Sign in to Peso Bank</h2>
                    <p class="mt-2 text-sm text-gray-500">Access your account and continue banking securely.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-green-700 hover:text-green-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>

                @if (Route::has('register'))
                    <p class="mt-6 text-center text-sm text-gray-600">
                        New here?
                        <a href="{{ route('register') }}" class="font-semibold text-green-700 hover:text-green-900">
                            Create an account
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
