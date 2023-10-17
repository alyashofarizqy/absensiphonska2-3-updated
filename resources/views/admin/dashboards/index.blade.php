<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    @push('meta-tags')
        <meta name="title" content="Dashboard Phonska">
        <meta name="description" content="Halaman dashboard phonska">
        <meta name="keywords" content="phonska,dashboard">
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div
                    class="p-5 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 sm:rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="">
                            <h5 class="text-zinc-900 dark:text-zinc-100 text-lg font-bold">Users</h5>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">Jumlah user yang terdaftar</p>
                        </div>
                        <div
                            class="h-8 w-8 bg-secondary-200 dark:bg-zinc-900 rounded-md flex justify-center items-center">
                            <i data-lucide="user-check-2" class="h-5 w-5 text-zinc-900 dark:text-zinc-100"></i>
                        </div>
                    </div>
                    <span class="text-zinc-800 dark:text-zinc-200 text-4xl font-bold">{{ $users }}</span>
                </div>

                <div
                    class="p-5 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 sm:rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="">
                            <h5 class="text-zinc-900 dark:text-zinc-100 text-lg font-bold">Absen TKNO</h5>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">Jumlah Absensi Pegawai TKNO</p>
                        </div>
                        <div
                            class="h-8 w-8 bg-secondary-200 dark:bg-zinc-900 rounded-md flex justify-center items-center">
                            <i data-lucide="briefcase" class="h-5 w-5 text-zinc-900 dark:text-zinc-100"></i>
                        </div>
                    </div>
                    <span class="text-zinc-800 dark:text-zinc-200 text-4xl font-bold">{{ $tknos }}</span>
                </div>

                <div
                    class="p-5 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 sm:rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="">
                            <h5 class="text-zinc-900 dark:text-zinc-100 text-lg font-bold">Absen Rekanan</h5>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">Jumlah Absensi Pegawai Rekanan</p>
                        </div>
                        <div
                            class="h-8 w-8 bg-secondary-200 dark:bg-zinc-900 rounded-md flex justify-center items-center">
                            <i data-lucide="folder-kanban" class="h-5 w-5 text-zinc-900 dark:text-zinc-100"></i>
                        </div>
                    </div>
                    <span class="text-zinc-800 dark:text-zinc-200 text-4xl font-bold">{{ $rekanans }}</span>
                </div>
            </div>

            <div
                class="p-8 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 sm:rounded-lg shadow-sm">
                <h5 class="text-zinc-900 dark:text-zinc-100 text-2xl font-bold mb-2">Absensi TKNO</h5>
                <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-6">Jumlah Absensi Pegawai TKNO dalam 20 hari
                    terakhir</p>

                <div x-data="{
                    chart: null,
                    mychart: null,
                    chartData: {
                        labels: {{ $labels }},
                        datasets: [{
                                label: 'Shift Pagi',
                                data: {{ $data['pagi'] }},
                                borderWidth: 2,
                                borderColor: '#add7cf',
                                backgroundColor: '#add7cf',
                            },
                            {
                                label: 'Shift Siang',
                                data: {{ $data['siang'] }},
                                borderWidth: 2,
                                borderColor: '#02c795',
                                backgroundColor: '#02c795',
                            },
                            {
                                label: 'Shift Malam',
                                data: {{ $data['malam'] }},
                                borderWidth: 2,
                                borderColor: '#004f40',
                                backgroundColor: '#004f40',
                            }
                        ]
                    },
                    chartOptions: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    },
                    init() {
                        Chart.defaults.font.family = 'Mona Sans, sans-serif';
                        mychart = document.getElementById('chart');
                        this.chart = new window.Chart(mychart, {
                            type: 'line',
                            data: this.chartData,
                            options: this.chartOptions
                        });
                    },
                }" x-init="init()" x-cloak>
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
