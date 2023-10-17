<div x-data="{ modal: @if ($errors->any()) true @else false @endif }" x-on:keydown.window.escape="modal = false" x-cloak>
    <x-button variant="primary" type="button" x-on:click="modal = !modal">Add User</x-button>

    <div x-cloak x-show="modal" x-transition.opacity class="fixed inset-0 z-40 bg-zinc-900/80 backdrop-blur-sm"></div>
    <div x-cloak x-show="modal" x-transition class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="w-screen max-w-2xl max-h-[80vh] overflow-y-scroll p-10 bg-white rounded-xl shadow-lg dark:bg-zinc-900 border       dark:border-zinc-700"
            x-on:click.away="modal = false">

            <div class="flex justify-end mb-4">
                <x-button x-on:click="modal = !modal" variant="outline"
                    class="relative items-center justify-center w-8 h-8">
                    <i class="absolute w-4 h-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="x"></i>
                </x-button>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">
                    Form Pegawai TKNO
                </h1>
                <p class="text-sm text-zinc-500">Silahkan isi form berikut untuk menambahkan pegawai TKNO, pastikan data
                    yang diisi benar.</p>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama')" class="mb-2" />
                    <x-text-input type="text" name="name" placeholder="Nama" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Nik -->
                <div class="mb-4">
                    <x-input-label for="nik" :value="__('NIK')" class="mb-2" />
                    <x-text-input type="text" name="nik" placeholder="NIK" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="mb-2" />
                    <x-text-input type="email" name="email" placeholder="Email" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="mb-2" />
                    <x-text-input type="password" name="password" placeholder="Password" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>

                <!-- Plant dan PT -->
                <div class="mb-4">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="plant" :value="__('Plant')" class="mb-2" />
                            {{-- <x-text-input type="text" name="plant" placeholder="Plant" class="w-full" /> --}}
                            <x-select-menu name="plant" class="w-full">
                                <option>Phonska II</option>
                                <option>Phonska III</option>
                            </x-select-menu>
                            <x-input-error class="mt-2" :messages="$errors->get('plant')" />
                        </div>

                        <div>
                            <x-input-label for="pt" :value="__('PT')" class="mb-2" />
                            <x-text-input type="text" name="pt" placeholder="PT" class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('pt')" />
                        </div>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" class="mb-2" />
                    <x-text-input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <x-input-label for="role" :value="__('Role')" class="mb-2" />
                    <x-select-menu name="role" id="role" class="w-full">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </x-select-menu>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>

                <!-- Submit and Close -->
                <div class="flex items-center justify-end space-x-2">
                    <x-button variant="secondary" type="button" x-on:click="modal = false">Cancel</x-button>
                    <x-button variant="primary" type="submit">Save</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
