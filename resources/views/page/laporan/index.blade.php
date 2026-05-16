<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-rose-50 to-purple-100 min-h-screen relative overflow-hidden">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-20 left-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float">
            </div>
            <div
                class="absolute bottom-20 right-10 w-80 h-80 bg-rose-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float animation-delay-2000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float animation-delay-4000">
            </div>
        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Welcome Section -->
            <div class="mb-8 text-center">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-rose-600 bg-clip-text text-transparent">
                    Cetak Laporan
                </h1>
                <p class="text-gray-500 mt-2">Pilih rentang waktu untuk mencetak rekapitulasi data booking dan pembayaran
                </p>
            </div>

            <!-- Main Card -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                </div>
                <div
                    class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">

                    <!-- Header -->
                    <div
                        class="px-8 py-6 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent text-center">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mb-4 shadow-md">
                            <i class="fas fa-file-alt text-2xl text-indigo-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 tracking-wide">Laporan Keuangan & Transaksi</h3>
                        <p class="text-sm text-gray-500 mt-2">Pilih rentang waktu untuk mencetak rekapitulasi data
                            booking dan pembayaran</p>
                    </div>

                    <div class="p-8 sm:p-10">
                        <form method="POST" action="{{ route('laporan.store') }}" target="_blank" class="space-y-6">
                            @csrf

                            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="dari"
                                            class="text-gray-700 font-medium mb-1.5 text-xs flex items-center">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i> Dari Tanggal
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-calendar-day text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="date" id="dari" name="dari"
                                                value="{{ date('Y-m-01') }}"
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                                required />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="sampai"
                                            class="text-gray-700 font-medium mb-1.5 text-xs flex items-center">
                                            <i class="fas fa-calendar-check text-rose-400 mr-2"></i> Sampai Tanggal
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-calendar-week text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="date" id="sampai" name="sampai"
                                                value="{{ date('Y-m-d') }}"
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                                required />
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Rentang Waktu -->
                                <div
                                    class="mt-4 p-3 bg-indigo-50/50 backdrop-blur-sm rounded-xl border border-indigo-100 flex items-center justify-between text-xs">
                                    <span class="text-indigo-600">
                                        <i class="fas fa-info-circle mr-1"></i> Rentang default: Awal bulan ini
                                    </span>
                                    <span class="text-gray-500">
                                        <i class="fas fa-print mr-1"></i> Laporan akan dibuka di tab baru
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row items-center justify-center gap-4 pt-4">
                                <button type="reset"
                                    class="w-full md:w-auto px-10 py-3 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-all tracking-wide text-center">
                                    <i class="fas fa-undo-alt mr-2"></i> Reset Tanggal
                                </button>

                                <button type="submit"
                                    class="w-full md:w-auto px-12 py-3 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:ring-4 focus:ring-indigo-500/20 transition-all tracking-wide text-center shadow-md flex items-center justify-center">
                                    <i class="fas fa-print mr-2"></i> Cetak Laporan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 border border-white/50 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-gray-600">Data Booking</p>
                    <p class="text-lg font-bold text-gray-800">Semua Status</p>
                </div>
                <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 border border-white/50 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-hand-holding-usd text-amber-500 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-gray-600">Data Pembayaran</p>
                    <p class="text-lg font-bold text-gray-800">DP & Lunas</p>
                </div>
                <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 border border-white/50 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-indigo-500 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-gray-600">Rekapitulasi</p>
                    <p class="text-lg font-bold text-gray-800">Periode Pilihan</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Smooth Transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Animation Delays for Background Elements */
        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Float Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) translateX(0px);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0.5;
            }
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        /* Menghilangkan underline pada link */
        a {
            text-decoration: none;
        }

        /* Custom focus style for inputs */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
        }
    </style>
</x-app-layout>
