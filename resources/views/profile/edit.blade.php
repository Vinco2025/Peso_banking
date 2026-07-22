<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Profile Settings</h2>
            <p class="text-sm text-gray-500 mt-1">Manage your personal information and security</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Information --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account --}}
            <div class="bg-white border border-red-100 rounded-2xl shadow-sm p-8">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>