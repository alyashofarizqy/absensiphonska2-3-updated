<x-app-layout>
    <x-slot name="title">
        {{ __('Phonska Users') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Manajemen User Phonska">
        <meta name="description" content="Halaman untuk mengelola user phonska">
        <meta name="keywords" content="phonska,users,manajemen user">
    @endpush

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
            <div class="flex items-center justify-between mb-6 px-3 sm:px-0">
                @include('admin.users.create')

                <!-- Session Status -->
                @if (session('status'))
                    <p x-data="{ flash: true }" x-show="flash" x-transition x-init="setTimeout(() => flash = false, 5000)"
                        class="text-sm text-phonska-800 dark:text-zinc-200">
                        {{ session('status') }}
                    </p>
                @endif
            </div>

            <!-- download csv button to 'users.download' route -->
            <div class="flex items-center justify-between mb-6 px-3 sm:px-0">

                <!-- Search -->
                <div x-cloak x-data="{ search: '{{ request('search') }}' }"
                    x-on:keydown.debounce.500ms="window.location = '{{ route('admin.users.index') }}?search=' + $event.target.value"
                    class="flex items-center w-full">
                    <x-text-input type="text" name="search" placeholder="Search" x-model="search" autofocus
                        class="w-full max-w-[300px] text-sm" />
                    <x-button x-show="search" x-on:click="window.location = '{{ route('admin.users.index') }}'"
                        variant="secondary" class="ml-2">
                        Clear
                    </x-button>
                </div>

                <!-- Download CSV -->
                <form action="{{ route('admin.users.download') }}" method="POST">
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
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">NIK</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">PT</th>
                                    <th class="px-4 py-3">Plant</th>
                                    <th class="px-4 py-3">Tanggal Lahir</th>
                                    <th class="px-4 py-3">Role</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users->isEmpty())
                                    <tr>
                                        <td colspan="10" class="px-4 py-20 text-center">
                                            <p class="text-zinc-500 dark:text-zinc-400">
                                                No data found.
                                            </p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($users as $user)
                                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                                            <td class="flex justify-center px-4 py-3">
                                                <i data-lucide="file-edit"
                                                    class="w-5 h-5 cursor-pointer text-zinc-400 hover:text-secondary-200"
                                                    x-on:click="window.location = '{{ route('admin.users.edit', ['user' => $user]) }}'">
                                            </td>

                                            <td class="px-4 py-3 min-w-[300px]">
                                                {{ $user->name }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $user->nik }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $user->email }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[150px]">
                                                @if ($user->pt)
                                                    <span
                                                        class="px-2 py-0.5 bg-phonska-800 text-white rounded-full text-xs">
                                                        {{ $user->pt }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $user->plant }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $user?->tanggal_lahir?->timezone('Asia/Jakarta')->format('d-m-Y') }}
                                            </td>

                                            <td class="px-4 py-3 min-w-[250px]">
                                                {{ $user->role }}
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
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
