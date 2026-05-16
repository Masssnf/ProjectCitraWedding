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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Welcome Section -->
            <div class="mb-8 text-center">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-rose-600 bg-clip-text text-transparent">
                    Wedding Dashboard
                </h1>
                <p class="text-gray-500 mt-2">Kelola dan pantau semua aktivitas wedding organizer Anda</p>
            </div>

            <!-- Stats Grid - Semua Card Memiliki Tinggi yang Sama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- Card 1: Total Pendapatan -->
                <div class="group relative h-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-white/50 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                                <i class="fas fa-money-bill-wave text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Total Pemasukan</p>
                            <p class="text-gray-800 text-3xl font-bold break-words">Rp
                                {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Booking -->
                <div class="group relative h-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-white/50 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                                <i class="fas fa-calendar-check text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Total Booking</p>
                            <p class="text-gray-800 text-3xl font-bold">{{ $totalBooking }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Client -->
                <div class="group relative h-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-rose-500 to-pink-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-white/50 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Total Client</p>
                            <p class="text-gray-800 text-3xl font-bold">{{ $totalClient }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Total Paket -->
                <div class="group relative h-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-white/50 h-full flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-500 text-sm mb-1">Total Paket</p>
                            <p class="text-gray-800 text-3xl font-bold break-words">{{ $totalPaket ?? 0 }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Jadwal Mendatang Section - Takes 2 columns -->
                <div class="lg:col-span-2">
                    <div class="relative group h-full">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                        </div>
                        <div
                            class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50 h-full flex flex-col">
                            <div
                                class="px-6 py-5 border-b border-white/30 flex items-center justify-between bg-gradient-to-r from-white/30 to-transparent flex-shrink-0">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-calendar-alt text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-800 font-bold text-lg">Jadwal Mendatang</h3>
                                        <p class="text-gray-500 text-xs">Acara dalam 30 hari ke depan</p>
                                    </div>
                                </div>
                                <span
                                    class="text-xs text-indigo-600 bg-indigo-100/80 px-3 py-1.5 rounded-full font-semibold backdrop-blur-sm flex-shrink-0">
                                    <i class="fas fa-calendar-week mr-1"></i> {{ $daftarAcara->count() }} Events
                                </span>
                            </div>

                            <div class="p-6 flex-1">
                                @if ($daftarAcara->isEmpty())
                                    <div class="text-center py-12 h-full flex items-center justify-center">
                                        <div>
                                            <div
                                                class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                                            </div>
                                            <p class="text-gray-500 font-medium">Belum ada jadwal tersimpan</p>
                                            <p class="text-gray-400 text-sm mt-1">Acara mendatang akan muncul di sini
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="space-y-3 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                                        @foreach ($daftarAcara as $acara)
                                            <div class="group/item relative">
                                                <div
                                                    class="relative flex items-center justify-between p-4 bg-white/50 backdrop-blur-sm rounded-xl hover:bg-white/80 transition-all duration-300 hover:shadow-md border border-white/30">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="relative">
                                                            <div
                                                                class="w-3 h-3 bg-indigo-500 rounded-full ring-4 ring-indigo-200">
                                                            </div>
                                                            @if (!$loop->last)
                                                                <div
                                                                    class="absolute top-3 left-1.5 w-0.5 h-12 bg-gradient-to-b from-indigo-300 to-transparent">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p class="text-gray-800 font-semibold">
                                                                {{ optional($acara->client)->namapl ?? 'Client tidak ditemukan' }}
                                                            </p>
                                                            <p class="text-gray-400 text-xs mt-1">
                                                                {{ optional($acara->client)->namatl ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <span
                                                            class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg shadow-sm whitespace-nowrap">
                                                            <i class="far fa-calendar-alt mr-1"></i>
                                                            {{ $acara->formatted_date }}
                                                        </span>
                                                        <p
                                                            class="text-indigo-500 text-xs mt-1 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity / Quick Actions Section -->
                <div class="lg:col-span-1">
                    <div class="relative group h-full">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-rose-400 to-pink-400 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                        </div>
                        <div
                            class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50 h-full flex flex-col">
                            <div
                                class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent flex-shrink-0">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-bolt text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-800 font-bold text-lg">Aksi Cepat</h3>
                                        <p class="text-gray-500 text-xs">Klik untuk akses halaman</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 space-y-3 flex-1">
                                <!-- Tombol Paket Baru -->
                                <a href="{{ route('paket.create') }}"
                                    class="w-full flex items-center justify-between p-3 bg-white/50 backdrop-blur-sm rounded-xl hover:bg-indigo-50 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-box text-indigo-600"></i>
                                        </div>
                                        <span class="text-gray-700 font-medium">Paket Baru</span>
                                    </div>
                                    <i
                                        class="fas fa-arrow-right text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                                </a>

                                <!-- Tombol Tambah Client -->
                                <a href="{{ route('client.create') }}"
                                    class="w-full flex items-center justify-between p-3 bg-white/50 backdrop-blur-sm rounded-xl hover:bg-rose-50 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-user-plus text-rose-600"></i>
                                        </div>
                                        <span class="text-gray-700 font-medium">Tambah Client</span>
                                    </div>
                                    <i
                                        class="fas fa-arrow-right text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                                </a>

                                <!-- Tombol Laporan Bulanan -->
                                <a href="{{ route('laporan.index') }}"
                                    class="w-full flex items-center justify-between p-3 bg-white/50 backdrop-blur-sm rounded-xl hover:bg-emerald-50 transition-all duration-300 group cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-chart-line text-emerald-600"></i>
                                        </div>
                                        <span class="text-gray-700 font-medium">Laporan Bulanan</span>
                                    </div>
                                    <i
                                        class="fas fa-arrow-right text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.8);
        }

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

        /* Memastikan semua card memiliki tinggi yang sama */
        .h-full {
            height: 100%;
        }

        /* Menghilangkan underline pada link */
        a {
            text-decoration: none;
        }
    </style>
</x-app-layout>
