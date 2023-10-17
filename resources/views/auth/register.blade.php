<x-guest-layout>
    <x-slot name="title">
        {{ __('Register') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Register Absensi TKNO">
        <meta name="description" content="Register pegawai untuk melakukan absensi TKNO">
        <meta name="keywords" content="phonska,absensi,pegawai">
    @endpush

    <div class="w-full max-w-lg bg-black/70 rounded-xl px-8 py-10">
        <x-auth-session-status class="mb-4 text-white" :status="session('status')" />
        <h1 class="text-secondary-200 font-bold text-3xl mb-4 text-center">Register TKNO</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-zinc-200" for="name">{{ __('Name') }}</label>
                <input id="name"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Enter your name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Nik -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-zinc-200" for="nik">{{ __('NIK') }}</label>
                <input id="nik"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70"
                    type="text" name="nik" :value="old('nik')" required autocomplete="nik"
                    placeholder="Enter your nik" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-zinc-200" for="email">{{ __('Email') }}</label>
                <input id="email"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70"
                    type="email" name="email" :value="old('email')" required autocomplete="email"
                    placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-zinc-200" for="password">{{ __('Password') }}</label>
                <input id="password"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block font-medium text-sm text-zinc-200"
                    for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Enter your password confirmation" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                @if (Route::has('password.request'))
                    <div class="flex justify-end mt-2">
                        <a class="text-sm text-zinc-300" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <x-button type="submit" variant="primary"
                class="flex items-center justify-center w-full py-4 font-semibold">
                {{ __('Register') }}
            </x-button>

            <div class="flex justify-center mt-2 text-sm text-zinc-300">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="ml-2 text-secondary-200">
                    {{ __('Login') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
