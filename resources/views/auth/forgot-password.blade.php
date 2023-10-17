<x-guest-layout>
    <x-slot name="title">
        {{ __('Forgot Password') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Password Recovery">
        <meta name="description" content="Phonska password recovery page">
        <meta name="keywords" content="phonska,password,recovery">
    @endpush




    <!-- Session Status -->
    <div class="w-full max-w-lg px-8 py-10 bg-black/70 rounded-xl">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h1 class="mb-4 text-3xl font-bold text-center text-secondary-200">Password Recovery</h1>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <label class="block font-medium text-sm text-zinc-200" for="nik">{{ __('NIK') }}</label>
                <input id="nik" type="text" name="nik" :value="old('nik')" required autofocus
                    autocomplete="nik" placeholder="Enter your NIK"
                    class="block mt-1 w-full bg-gradient-to-br from-[#7c7a78] to-[#141210] border border-[#717172] placeholder:text-zinc-400 py-3 text-zinc-100 focus:border-secondary-200 focus:ring-secondary-300 rounded-lg opacity-70" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />

                <div class="flex justify-end mt-2">
                    <a class="text-sm text-zinc-300" href="{{ route('login') }}">
                        {{ __('Back to login page') }}
                    </a>
                </div>
            </div>

            <x-button type="submit" variant="primary"
                class="flex items-center justify-center w-full py-4 font-semibold">
                {{ __('Login') }}
            </x-button>
        </form>
    </div>
</x-guest-layout>
