<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Open New Account</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('accounts.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Account Type</label>
                    <select name="type"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                        <option value="savings">Savings</option>
                        <option value="checking">Checking</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Open Account
                </button>
            </form>

        </div>
    </div>
</x-app-layout>