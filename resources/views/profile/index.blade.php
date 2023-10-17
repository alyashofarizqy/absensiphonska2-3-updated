<x-app-layout>
    <x-slot name="title">
        {{ __('Profile') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="User Profile">
        <meta name="description" content="Profile Pegawai TKNO PHONSKA">
        <meta name="keywords" content="profile,pegawai,tkno,phonska">
    @endpush

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-zinc-800 sm:rounded-lg">
                <section class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                            {{ __('Profile Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                            {{ __("Update your account's profile information and email address.") }}
                        </p>
                    </header>

                    <div class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="nik" :value="__('NIK')" />
                            <x-text-input id="nik" name="nik" type="text" class="block w-full mt-1"
                                :value="$user->nik" disabled readolny />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="$user->name" disabled readolny />
                        </div>

                        <div>
                            <x-input-label for="plant" :value="__('Plant')" />
                            <x-text-input id="plant" name="plant" type="text" class="block w-full mt-1"
                                :value="$user->plant" disabled readolny />
                        </div>

                        <div>
                            <x-input-label for="pt" :value="__('PT')" />
                            <x-text-input id="pt" name="pt" type="text" class="block w-full mt-1"
                                :value="$user->pt" disabled readolny />
                        </div>

                        <div>
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                class="block w-full mt-1" :value="Illuminate\Support\Carbon::parse($user->tanggal_lahir)->format('Y-m-d')" disabled readonly />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
