<x-guest-layout>
    <x-slot name="title">
        {{ __('Welcome') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Phonska Absensi">
        <meta name="description" content="Pilih jenis absensi yang ingin anda lakukan">
        <meta name="keywords" content="phonska,absensi,pegawai">
    @endpush

    <div class="container">
        <div class="grid grid-cols-1 gap-4 px-10 lg:grid-cols-2 lg:px-0">
            <div class="flex flex-col items-center justify-center p-10 rounded-xl bg-black/70 text-secondary-200">
                <h3 class="mb-2 text-2xl font-bold">Absensi TKNO</h3>
                <p class="mb-4 text-center text-zinc-400">Login bagi pegawai TKNO yang memiliki akun</p>
                <div class="flex items-center justify-center">
                    <a href="{{ route('login') }}">
                        <x-button variant="primary">
                            Masuk TKNO
                        </x-button>
                    </a>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center p-10 rounded-xl bg-black/70 text-secondary-200">
                <h3 class="mb-2 text-2xl font-bold">Absensi Rekanan</h3>
                <p class="mb-4 text-center text-zinc-400">Akses absensi bagi pegawai rekanan</p>
                <div class="flex items-center justify-center">
                    <a href="{{ route('rekanans.index') }}">
                        <x-button variant="primary">
                            Masuk Rekanan
                        </x-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
