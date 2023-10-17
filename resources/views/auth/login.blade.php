<x-guest-layout>
    <x-slot name="title">
        {{ __('Login') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Login Absensi TKNO">
        <meta name="description" content="Login untuk melakukan absensi TKNO">
        <meta name="keywords" content="phonska,absensi,pegawai">
    @endpush

    <div class="w-full max-w-lg px-8 py-10 bg-black/70 rounded-xl">
        <x-auth-session-status class="mb-4 text-zinc-100" :status="session('status')" />
        <h1 class="mb-4 text-3xl font-bold text-center text-secondary-200">Absensi TKNO</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Nik -->
            <div class="mb-4">
                <label class="block font-medium text-sm text-zinc-200" for="nik">{{ __('NIK') }}</label>
                <input id="nik" type="text" name="nik" :value="old('nik')" required autofocus
                    autocomplete="nik" placeholder="Enter your NIK"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-8">
                <label class="block font-medium text-sm text-zinc-200" for="password">{{ __('Password') }} </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Enter your password"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

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
                {{ __('Login') }}
            </x-button>

            @if (Route::has('register'))
                <div class="flex justify-center mt-2 space-x-2 text-sm text-zinc-300">
                    {{ __('Don\'t have an account?') }}
                    <a href="{{ route('register') }}" class="ml-2 text-secondary-200">
                        {{ __('Register') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</x-guest-layout>
