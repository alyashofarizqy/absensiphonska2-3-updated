@push('scripts')
    <script>
        let photo = null;
        let image = null;
        let video = null;
        let canvas = null;
        let latitude = null;
        let longitude = null;
        let coordinate = null;

        function init() {
            photo = document.querySelector('[x-ref="photo"]');
            image = document.querySelector('[x-ref="image"]');
            video = document.querySelector('[x-ref="video"]');
            canvas = document.querySelector('[x-ref="canvas"]');
            latitude = document.querySelector('[x-ref="latitude"]');
            longitude = document.querySelector('[x-ref="longitude"]');
            coordinate = document.querySelector('[x-ref="coordinate"]');
        }

        async function capture() {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            image.src = canvas.toDataURL('image/png');
            photo.value = image.src;
            image.style.display = 'block';
            video.style.display = 'none';
        }

        async function start() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                });
                navigator.geolocation.watchPosition(function(position) {
                    latitude.value = position.coords.latitude;
                    longitude.value = position.coords.longitude;
                    coordinate.innerHTML = position.coords.latitude + ', ' + position.coords.longitude;
                    console.log(position.coords.latitude + ', ' + position.coords.longitude);
                });
                handleSuccess(stream);
            } catch (e) {
                handleError(e);
            }
        }

        async function reset() {
            image.src = null;
            photo.value = null;
            image.style.display = 'none';
            video.style.display = 'block';
        }

        function handleSuccess(stream) {
            window.stream = stream;
            video.srcObject = stream;
        }

        function handleError(error) {
            console.error('Error: ', error);
        }

        function stop(e) {
            e.preventDefault();
            const stream = window.stream;
            const tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });
            video.srcObject = null;
            video.style.display = 'block';
            image.style.display = 'none';
        }

        function openModal() {
            modal = true;
            start();
        }

        function closeModal() {
            modal = false;
            stop(event);
        }
    </script>
@endpush

<div x-cloak x-data="{ modal: @if ($errors->any()) true @else false @endif }" x-init="init();
@if ($errors->any()) start() @endif" x-on:keydown.window.escape="modal = false; stop(event)">

    <!-- Button -->
    <x-button variant="primary" type="button" x-on:click="modal = !modal; start()">
        Absen
    </x-button>

    <!-- Overlay -->
    <div x-cloak x-show="modal" x-transition.opacity class="fixed inset-0 z-40 bg-zinc-900/80 backdrop-blur-sm"></div>

    <!-- Modal -->
    <div x-cloak x-show="modal" x-transition class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="w-screen max-w-2xl max-h-[80vh] overflow-y-scroll p-10 bg-white rounded-xl shadow-lg dark:bg-zinc-900 border       dark:border-zinc-700"
            x-on:click.away="modal = false; stop(event)">

            <!-- Close Button -->
            <div class="flex justify-end mb-4">
                <x-button x-on:click="modal = !modal; stop(event)" variant="outline"
                    class="relative items-center justify-center w-8 h-8">
                    <i class="absolute w-4 h-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="x"></i>
                </x-button>
            </div>

            <!-- Modal Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50">
                    Absen TKNO
                </h1>
                <p class="text-sm text-zinc-500">Silahkan isi form berikut untuk absen tkno, pastikan data yang
                    diisi benar.</p>
            </div>


            <!-- Form -->
            <form action="{{ route('absens.store') }}" method="POST" class="w-full">
                @csrf

                <!-- Refs for alpinejs -->
                <div class="relative w-full aspect-[4/3] mb-4 bg-zinc-100 dark:bg-zinc-800 rounded-lg overflow-hidden">
                    <video x-ref="video" height="480" width="640" class="w-full h-full object-cover object-center"
                        autoplay playsinline></video>
                    <canvas x-ref="canvas" height="480" width="640"
                        class="w-full h-full object-cover object-center" style="display: none;"></canvas>
                    <img x-ref="image" class="w-full h-full object-cover object-center" style="display: none;" />
                    <input type="text" name="photo" x-ref="photo" id="photo" />

                    <!-- Camera Controls -->
                    <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center space-x-2 p-4">
                        <x-icon-button icon="rotate-ccw" label="Rotate" variant="secondary" x-on:click="reset()" />
                        <x-icon-button icon="camera" label="Capture" variant="secondary" x-on:click="capture()" />
                    </div>
                </div>

                <x-input-error :messages="$errors->get('latitude')" class="mb-4" />
                <x-input-error :messages="$errors->get('longitude')" class="mb-4" />
                <x-input-error :messages="$errors->get('photo')" class="mb-4" />

                <div class="flex justify-between items-center">

                    <!-- Coordinate -->
                    <div class="flex items-center space-x-2 text-zinc-500 dark:text-zinc-400 text-sm">
                        <i class="w-4 h-4" data-lucide="map-pin"></i>
                        <span x-show="modal" x-ref="coordinate" id="coordinate">Loading...</span>
                        <input type="hidden" name="latitude" x-ref="latitude" id="latitude" readonly>
                        <input type="hidden" name="longitude" x-ref="longitude" id="longitude" readonly>
                    </div>

                    <!-- Submit and Close -->
                    <div class="flex items-center justify-end space-x-2">
                        <x-button variant="secondary" type="button"
                            x-on:click="modal = false; stop(event)">Cancel</x-button>
                        <x-button variant="primary" type="submit">Save</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
