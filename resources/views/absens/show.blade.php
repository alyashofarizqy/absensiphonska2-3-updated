<div x-on:keydown.escape="rekap = null" x-show="rekap" x-cloak>
    <div x-cloak x-show="rekap" x-transition.opacity class="fixed inset-0 z-40 bg-zinc-900/80 backdrop-blur-sm"></div>

    <div x-cloak x-show="rekap" x-transition class="fixed inset-0 z-50 flex items-center justify-center">
        <div x-on:click.away="rekap = null"
            class="w-screen max-w-2xl max-h-[80vh] overflow-y-scroll p-10 bg-white rounded-xl shadow-lg dark:bg-zinc-900 border       dark:border-zinc-700">

            <div class="flex justify-end mb-4">
                <x-button x-on:click="rekap = null" variant="outline"
                    class="relative items-center justify-center w-8 h-8">
                    <i class="absolute w-4 h-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="x"></i>
                </x-button>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">
                    Show Detail Absen rekap
                </h1>
                <p class="text-sm text-zinc-500">Berikut detail absensi pegawai.</p>
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <x-input-label for="nama" :value="__('Nama')" class="mb-2" />
                <x-text-input type="text" name="nama" placeholder="Nama" class="w-full"
                    x-bind:value="rekap?.user?.name" readonly />
            </div>

            <!-- Nik -->
            <div class="mb-4">
                <x-input-label for="nik" :value="__('NIK')" class="mb-2" />
                <x-text-input type="text" name="nik" placeholder="NIK" class="w-full"
                    x-bind:value="rekap?.user?.nik" readonly />
            </div>

            <!-- Shift and Plant -->
            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <x-input-label for="shift" :value="__('Shift')" class="mb-2" />
                        <x-text-input type="text" name="shift" placeholder="Shift" class="w-full"
                            x-bind:value="rekap?.shift" readonly />
                    </div>
                    <div>
                        <x-input-label for="plant" :value="__('Plant')" class="mb-2" />
                        <x-text-input type="text" name="plant" placeholder="Plant" class="w-full"
                            x-bind:value="rekap?.plant" readonly />
                    </div>
                </div>
            </div>

            <!-- Checkin -->
            <div class="mb-4" x-show="rekap?.checkin">
                <x-input-label for="checkin" :value="__('Checkin')" class="mb-2" />
                <div
                    class="w-full aspect-[4/3] rounded-lg overflow-hidden relative border border-zinc-200 dark:border-zinc-700">
                    <img class="object-cover w-full h-full" x-bind:src="rekap?.checkin?.photo" alt="checkin image" />

                    <!-- Checkin Detail -->
                    <div
                        class="absolute bottom-0 left-0 w-full p-4 bg-zinc-50 dark:bg-zinc-900 flex justify-between items-center">

                        <!-- Checkin Location -->
                        <p class="text-sm  text-zinc-700 dark:text-zinc-300 flex items-center justify-start space-x-2">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                            <span x-text="rekap?.checkin?.latitude"></span>
                            <span x-text="rekap?.checkin?.longitude"></span>
                        </p>

                        <!-- Checkin Time -->
                        <p class="text-sm  text-zinc-700 dark:text-zinc-300 flex items-center justify-end space-x-2">
                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                            <span>Jam</span>
                            <span
                                x-text="
                        new Date(rekap?.checkin?.created_at).toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        })
                    "></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Checkout -->
            <div class="mb-4" x-show="rekap?.checkout">
                <x-input-label for="checkout" :value="__('Checkout')" class="mb-2" />
                <div
                    class="w-full aspect-[4/3] rounded-lg overflow-hidden relative border border-zinc-200 dark:border-zinc-700 mb-4">
                    <img class="object-cover w-full h-full" x-bind:src="rekap?.checkout?.photo" alt="checkout image" />

                    <!-- Checkout Detail -->
                    <div
                        class="absolute bottom-0 left-0 w-full p-4 bg-zinc-50 dark:bg-zinc-900 flex justify-between items-center">

                        <!-- Checkout Location -->
                        <p class="text-sm  text-zinc-700 dark:text-zinc-300 flex items-center justify-start space-x-2">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                            <span x-text="rekap?.checkout?.latitude"></span>
                            <span x-text="rekap?.checkout?.longitude"></span>
                        </p>

                        <!-- Checkout Time -->
                        <p class="text-sm  text-zinc-700 dark:text-zinc-300 flex items-center justify-end space-x-2">
                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                            <span>Jam</span>
                            <span
                                x-text="
                        new Date(rekap?.checkout?.created_at).toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        })
                    "></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Submit and Close -->
            <div class="flex items-center justify-end space-x-2">
                <x-button variant="primary" type="button" x-on:click="rekap = null">Close</x-button>
            </div>
        </div>
    </div>
</div>
