<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register — Peso Bank</title>
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
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.25em] text-green-700">Open an Account</p>
                    <h1 class="mb-4 text-4xl font-bold leading-tight text-gray-900">
                        Start banking with a <span class="text-green-700">smarter, safer experience</span>
                    </h1>
                    <p class="text-lg leading-relaxed text-gray-600">
                        Create your Peso Bank profile and gain instant access to deposits, transfers, and secure account management.
                    </p>
                </div>
            </div>

            <div class="rounded-3xl border border-green-100 bg-white p-8 shadow-2xl shadow-green-100 sm:p-10">
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100">
                        <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
                    <p class="mt-2 text-sm text-gray-500">Join Peso Bank and manage your money with confidence.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="relative mt-1">
                            <x-text-input id="password" class="mt-1 block w-full pr-12" type="password" name="password" required autocomplete="new-password" />
                            <button type="button" id="password-toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700" aria-label="Show password">
                                <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-closed" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.183-3.568m2.562-2.09A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.043 5.03M15 12a3 3 0 11-6 0 3 3 0 016 0zm-8.5 8.5L19.5 4.5" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <div class="relative mt-1">
                            <x-text-input id="password_confirmation" class="mt-1 block w-full pr-12" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <button type="button" id="confirm-password-toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700" aria-label="Show password">
                                <svg id="confirm-eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="confirm-eye-closed" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.183-3.568m2.562-2.09A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.043 5.03M15 12a3 3 0 11-6 0 3 3 0 016 0zm-8.5 8.5L19.5 4.5" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a class="text-sm font-medium text-green-700 hover:text-green-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        const confirmPasswordInput = document.getElementById('password_confirmation');
        const confirmPasswordToggle = document.getElementById('confirm-password-toggle');
        const confirmEyeOpen = document.getElementById('confirm-eye-open');
        const confirmEyeClosed = document.getElementById('confirm-eye-closed');

        if (passwordInput && passwordToggle && eyeOpen && eyeClosed) {
            passwordToggle.addEventListener('click', () => {
                const isPasswordHidden = passwordInput.type === 'password';
                passwordInput.type = isPasswordHidden ? 'text' : 'password';
                passwordToggle.setAttribute('aria-label', isPasswordHidden ? 'Hide password' : 'Show password');
                eyeOpen.classList.toggle('hidden', !isPasswordHidden);
                eyeClosed.classList.toggle('hidden', isPasswordHidden);
            });
        }

        if (confirmPasswordInput && confirmPasswordToggle && confirmEyeOpen && confirmEyeClosed) {
            confirmPasswordToggle.addEventListener('click', () => {
                const isPasswordHidden = confirmPasswordInput.type === 'password';
                confirmPasswordInput.type = isPasswordHidden ? 'text' : 'password';
                confirmPasswordToggle.setAttribute('aria-label', isPasswordHidden ? 'Hide password' : 'Show password');
                confirmEyeOpen.classList.toggle('hidden', !isPasswordHidden);
                confirmEyeClosed.classList.toggle('hidden', isPasswordHidden);
            });
        }
    </script>
</body>
</html>
