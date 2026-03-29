<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                Profile Settings
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Manage your account information and security
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl space-y-6 sm:px-6 lg:px-8">

            <!-- Profile Information -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm 
                        dark:border-gray-700 dark:bg-gray-800">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Profile Information
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Update your name and email address.
                    </p>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm 
                        dark:border-gray-700 dark:bg-gray-800">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Update Password
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Ensure your account is using a strong password.
                    </p>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="rounded-2xl border border-red-200 bg-white p-6 shadow-sm 
                        dark:border-red-700 dark:bg-gray-800">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">
                        Delete Account
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Permanently delete your account. This action cannot be undone.
                    </p>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>