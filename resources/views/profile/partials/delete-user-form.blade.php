<section>
    <div class="flex items-center gap-3 mb-6">
        <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <div>
            <h2 class="text-base font-semibold text-red-700">Delete Account</h2>
            <p class="text-xs text-gray-400">Permanently delete your account and all data</p>
        </div>
    </div>

    <p class="text-sm text-gray-500 mb-5">
        Once your account is deleted, all of its resources and data will be permanently removed.
        Please download any data you wish to retain before proceeding.
    </p>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow transition">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-semibold text-gray-800 mb-1">Are you sure?</h2>
            <p class="text-sm text-gray-500 mb-5">
                This action is permanent. Please enter your password to confirm deletion.
            </p>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <x-text-input id="password" name="password" type="password" class="block w-full border-gray-200 rounded-lg text-sm" placeholder="Enter your password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow transition">
                    Yes, Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>