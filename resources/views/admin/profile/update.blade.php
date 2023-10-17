<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" name="nik" type="text" class="block w-full mt-1" :value="old('nik', $user->nik)" required
                autofocus autocomplete="nik" />
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="plant" :value="__('Plant')" />
            <x-text-input id="plant" name="plant" type="text" class="block w-full mt-1" :value="old('plant', $user->plant)"
                autofocus autocomplete="plant" />
            <x-input-error class="mt-2" :messages="$errors->get('plant')" />
        </div>

        <div>
            <x-input-label for="pt" :value="__('PT')" />
            <x-text-input id="pt" name="pt" type="text" class="block w-full mt-1" :value="old('pt', $user->pt)"
                autofocus autocomplete="pt" />
            <x-input-error class="mt-2" :messages="$errors->get('pt')" />
        </div>

        <div>
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="block w-full mt-1"
                :value="old(
                    'tanggal_lahir',
                    Illuminate\Support\Carbon::parse($user->tanggal_lahir)->format('Y-m-d'),
                )" autofocus autocomplete="tanggal_lahir" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
        </div>


        <div class="flex items-center gap-4">
            <x-button type="submit" variant="primary">{{ __('Save') }}</x-button>

            @if (session('status'))
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-zinc-600 dark:text-zinc-400">
                    {{ session('status') }}
                </p>
            @endif
        </div>
    </form>
</section>
