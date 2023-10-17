<div x-on:keydown.escape="rekanan = null" x-show="rekanan" x-cloak>
    <div x-cloak x-show="rekanan" x-transition.opacity class="fixed inset-0 z-40 bg-zinc-900/80 backdrop-blur-sm"></div>

    <div x-cloak x-show="rekanan" x-transition class="fixed inset-0 z-50 flex items-center justify-center">
        <div x-on:click.away="rekanan = null"
            class="w-screen max-w-2xl max-h-[80vh] overflow-y-scroll p-10 bg-white rounded-xl shadow-lg dark:bg-zinc-900 border       dark:border-zinc-700">

            <div class="flex justify-end mb-4">
                <x-button x-on:click="rekanan = null" variant="outline"
                    class="relative items-center justify-center w-8 h-8">
                    <i class="absolute w-4 h-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="x"></i>
                </x-button>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">
                    Show Detail Rekanan
                </h1>
                <p class="text-sm text-zinc-500">Berikut detail rekanan yang dipilih.</p>
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <x-input-label for="nama" :value="__('Nama')" class="mb-2" />
                <x-text-input type="text" name="nama" placeholder="Nama" class="w-full"
                    x-bind:value="rekanan?.nama" readonly />
            </div>

            <!-- Telepon and Unit -->
            <div class="mb-4">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <x-input-label for="telepon" :value="__('Telepon')" class="mb-2" />
                        <x-text-input type="text" name="telepon" placeholder="Telepon" class="w-full"
                            x-bind:value="rekanan?.telepon" readonly />
                    </div>
                    <div>
                        <x-input-label for="unit" :value="__('Unit')" class="mb-2" />
                        <x-text-input type="text" name="unit" placeholder="Unit" class="w-full"
                            x-bind:value="rekanan?.unit" readonly />
                    </div>
                </div>
            </div>

            <!-- Item -->
            <div class="mb-4">
                <x-input-label for="item" :value="__('Item')" class="mb-2" />
                <x-text-input type="text" name="item" placeholder="Item" class="w-full"
                    x-bind:value="rekanan?.item" readonly />
            </div>

            <!-- Pekerjaan -->
            <div class="mb-4">
                <x-input-label for="pekerjaan" :value="__('Pekerjaan')" class="mb-2" />
                <x-text-input type="text" name="pekerjaan" placeholder="Pekerjaan" class="w-full"
                    x-bind:value="rekanan?.pekerjaan" readonly />
            </div>

            <!-- No Permit -->
            <div class="mb-4">
                <x-input-label for="no_permit" :value="__('No Permit')" class="mb-2" />
                <x-text-input type="text" name="no_permit" placeholder="No Permit" class="w-full"
                    x-bind:value="rekanan?.no_permit" readonly />
            </div>

            <!-- Rekanan -->
            <div class="mb-4">
                <x-input-label for="rekanan" :value="__('Rekanan')" class="mb-2" />
                <x-text-input type="text" name="rekanan" placeholder="Rekanan" class="w-full"
                    x-bind:value="rekanan?.rekanan" readonly />
            </div>

            <!-- Open and Close -->
            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <x-input-label for="open" :value="__('Jam Open')" class="mb-2" />
                        <x-text-input type="text" name="open" placeholder="Jam Open" class="w-full"
                            x-bind:value="rekanan?.open" readonly />
                    </div>
                    <div>
                        <x-input-label for="close" :value="__('Jam Close')" class="mb-2" />
                        <x-text-input type="text" name="close" placeholder="Jam Close" class="w-full"
                            x-bind:value="rekanan?.close" readonly />
                    </div>
                </div>
            </div>

            <!-- Submit and Close -->
            <div class="flex items-center justify-end space-x-2">
                <x-button variant="primary" type="button" x-on:click="rekanan = null">Close</x-button>
            </div>
        </div>
    </div>
</div>
