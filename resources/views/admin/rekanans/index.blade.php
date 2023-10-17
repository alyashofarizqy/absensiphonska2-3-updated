<x-app-layout>
    <x-slot name="title">
        {{ __('Absensi Rekanan') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Absensi Rekanan">
        <meta name="description" content="Management Absensi Rekanan">
        <meta name="keywords" content="phonska,absensi,rekanan">
    @endpush

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Absensi Rekanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-data="{ rekanan: null }" x-cloak>
            <div class="flex items-center justify-end px-3 sm:px-0">
                @include('admin.rekanans.show')

                <!-- Session Status -->
                @if (session('status'))
                    <p x-data="{ flash: true }" x-show="flash" x-transition x-init="setTimeout(() => flash = false, 5000)"
                        class="text-sm text-phonska-800 dark:text-zinc-200 mb-6">
                        {{ session('status') }}
                    </p>
                @endif
            </div>

            <!-- download csv button to 'rekanans.download' route -->
            <div class="flex items-center justify-between mb-6 px-3 sm:px-0">

                <!-- Search -->
                <div x-cloak x-data="{ search: '{{ request('search') }}' }"
                    x-on:keydown.debounce.500ms="window.location = '{{ route('rekanans.index') }}?search=' + $event.target.value"
                    class="flex items-center w-full">
                    <x-text-input type="text" name="search" placeholder="Search" x-model="search" autofocus
                        class="w-full max-w-[300px] text-sm" />
                    <x-button x-show="search" x-on:click="window.location = '{{ route('rekanans.index') }}'"
                        variant="secondary" class="ml-2">
                        Clear
                    </x-button>
                </div>

                <!-- Download CSV -->
                <form action="{{ route('admin.rekanans.download') }}" method="POST">
                    @csrf
                    <x-button variant="secondary" type="submit">
                        Download
                    </x-button>
                </form>
            </div>

            <div class="mb-6 overflow-hidden bg-white shadow-sm dark:bg-zinc-800 sm:rounded-lg">
                <div class="border text-zinc-900 border-zinc-200 dark:text-zinc-100 dark:border-zinc-700">
                    <div id="table" class="w-full overflow-x-scroll">
                        <table class="w-full text-sm whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="font-bold text-left text-zinc-600 bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200">
                                    <th class="px-4 py-3">Action</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Telepon</th>
                                    <th class="px-4 py-3">Unit</th>
                                    <th class="px-4 py-3">Item</th>
                                    <th class="px-4 py-3">Pekerjaan</th>
                                    <th class="px-4 py-3">No Permit</th>
                                    <th class="px-4 py-3">Rekanan</th>
                                    <th class="px-4 py-3">Open</th>
                                    <th class="px-4 py-3">Close</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($rekanans->isEmpty())
                                    <tr>
                                        <td colspan="10" class="px-4 py-20 text-center">
                                            <p class="text-zinc-500 dark:text-zinc-400">
                                                No data found.
                                            </p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($rekanans as $rekanan)
                                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                                            <td class="flex justify-center px-4 py-3">
                                                <i x-cloak x-on:click="rekanan = {{ $rekanan }}" data-lucide="eye"
                                                    class="w-5 h-5 cursor-pointer text-zinc-400 hover:text-secondary-200" />
                                            </td>

                                            <td class="px-4 py-3 min-w-[200px]">
                                                {{ $rekanan->created_at->timezone('Asia/Jakarta')->format('d F Y') }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[300px]">
                                                {{ $rekanan->nama }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $rekanan->telepon }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[100px]">
                                                <span
                                                    class="px-2 py-0.5 bg-phonska-800 text-white rounded-full text-xs">
                                                    {{ $rekanan->unit }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $rekanan->item }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $rekanan->pekerjaan }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[150px]">
                                                {{ $rekanan->no_permit }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $rekanan->rekanan }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[100px]">
                                                {{ Illuminate\Support\Carbon::parse($rekanan->open)->format('H:i') }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[100px]">
                                                {{ Illuminate\Support\Carbon::parse($rekanan->close)->format('H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div>
                {{ $rekanans->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
