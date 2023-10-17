<div x-data="{ modal: @if ($errors->any()) true @else false @endif }" x-on:keydown.window.escape="modal = false" x-cloak>
    <x-button variant="primary" type="button" x-on:click="modal = !modal">Absen</x-button>

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
                    Absen Rekanan
                </h1>
                <p class="text-sm text-zinc-500">Silahkan isi form berikut untuk absen rekanan, pastikan data yang
                    diisi benar.</p>
            </div>

            <form action="{{ route('rekanans.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <x-input-label for="nama" :value="__('Nama')" class="mb-2" />
                    <x-text-input type="text" name="nama" placeholder="Nama" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                </div>

                <!-- Telepon and Unit -->
                <div class="mb-4">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="telepon" :value="__('Telepon')" class="mb-2" />
                            <x-text-input type="text" name="telepon" placeholder="Telepon" class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('telepon')" />
                        </div>
                        <div>
                            <x-input-label for="unit" :value="__('Unit')" class="mb-2" />
                            <x-text-input type="text" name="unit" placeholder="Unit" class="w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="mb-4">
                    <x-input-label for="item" :value="__('Item')" class="mb-2" />
                    <x-text-input type="text" name="item" placeholder="Item" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('item')" />
                </div>

                <!-- Pekerjaan -->
                <div class="mb-4">
                    <x-input-label for="pekerjaan" :value="__('Pekerjaan')" class="mb-2" />
                    <x-text-input type="text" name="pekerjaan" placeholder="Pekerjaan" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
                </div>

                <!-- No Permit -->
                <div class="mb-4">
                    <x-input-label for="no_permit" :value="__('No Permit')" class="mb-2" />
                    <x-text-input type="text" name="no_permit" placeholder="No Permit" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('no_permit')" />
                </div>

                <!-- Rekanan -->
                <div class="mb-4">
                    <x-input-label for="rekanan" :value="__('Rekanan')" class="mb-2" />
                    <x-text-input type="text" name="rekanan" placeholder="Rekanan" class="w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('rekanan')" />
                </div>

                <!-- Open and Close -->
                <div class="mb-8">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="open" :value="__('Jam Open')" class="mb-2" />
                            <x-select-menu name="open" id="open" class="w-full">
                                <option value="07:00">07:00</option>
                                <option value="15:00">15:00</option>
                                <option value="23:00">23:00</option>
                            </x-select-menu>
                            <x-input-error class="mt-2" :messages="$errors->get('open')" />
                        </div>
                        <div>
                            <x-input-label for="close" :value="__('Jam Close')" class="mb-2" />
                            <x-select-menu name="close" id="close" class="w-full">
                                <option value="07:00">07:00</option>
                                <option value="15:00">15:00</option>
                                <option value="23:00">23:00</option>
                            </x-select-menu>
                            <x-input-error class="mt-2" :messages="$errors->get('close')" />
                        </div>
                    </div>
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
