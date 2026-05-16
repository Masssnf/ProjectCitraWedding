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

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Welcome Section -->
            <div class="mb-8 text-center">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-rose-600 bg-clip-text text-transparent">
                    Form Booking Baru
                </h1>
                <p class="text-gray-500 mt-2">Catat pesanan layanan wedding, tentukan jadwal acara, dan pilih paket yang
                    sesuai</p>
            </div>

            <!-- Main Card -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                </div>
                <div
                    class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">

                    <!-- Header -->
                    <div class="px-8 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-shopping-cart text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Buat Transaksi / Booking</h3>
                                <p class="text-gray-500 text-xs">Catat pesanan layanan wedding, tentukan jadwal acara,
                                    dan pilih paket yang sesuai</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 sm:p-10">
                        <form method="POST" action="{{ route('transaksi.store') }}" class="space-y-8">
                            @csrf

                            <!-- Alert Error Validasi -->
                            @if ($errors->any())
                                <div
                                    class="bg-rose-50/80 backdrop-blur-sm border border-rose-200 text-rose-700 px-6 py-4 rounded-xl relative mb-6 text-sm">
                                    <strong class="font-bold block mb-1 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i> Terjadi kesalahan!
                                    </strong>
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Identitas Transaksi & Klien -->
                            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                                <h4
                                    class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-4 flex items-center">
                                    <i class="fas fa-address-card mr-2"></i> 1. Identitas Transaksi & Klien
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div>
                                        <x-input-label for="kode_invoice" value="Kode Invoice (Otomatis)"
                                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-file-invoice text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="text" id="kode_invoice" name="kode_invoice"
                                                value="{{ $kode_invoice }}"
                                                class="block w-full pl-10 bg-gray-100/50 border-white/50 rounded-xl text-sm text-gray-600 cursor-not-allowed font-mono tracking-wider"
                                                readonly required />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="id_client" class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-users text-indigo-400 mr-1"></i> Klien / Pemesan
                                        </x-input-label>

                                        @if (Auth::user()->role === 'CLIENT')
                                            @php
                                                $myClient = $client->where('id_user', Auth::id())->first();
                                            @endphp

                                            @if ($myClient)
                                                <input type="hidden" name="id_client" value="{{ $myClient->id }}">
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <i class="fas fa-user-check text-gray-400 text-sm"></i>
                                                    </div>
                                                    <x-text-input type="text"
                                                        value="{{ $myClient->namapl }} & {{ $myClient->namapr }}"
                                                        class="block w-full pl-10 bg-gray-100/50 border-white/50 rounded-xl text-sm text-gray-600 cursor-not-allowed font-medium"
                                                        readonly required />
                                                </div>
                                                <p class="text-[10px] text-indigo-500 mt-1 italic">
                                                    <i class="fas fa-info-circle mr-1"></i> *Booking akan tercatat atas
                                                    nama Anda.
                                                </p>
                                            @else
                                                <div
                                                    class="p-3 bg-rose-50/80 backdrop-blur-sm border border-rose-200 rounded-xl text-rose-600 text-sm flex items-start">
                                                    <i
                                                        class="fas fa-exclamation-triangle text-rose-500 mr-2 mt-0.5"></i>
                                                    <div>
                                                        <strong>Profil Klien Belum Lengkap!</strong><br>
                                                        Sistem mendeteksi Anda belum memiliki profil data klien. Harap
                                                        hubungi Admin untuk melengkapi data Anda.
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-user-tie text-gray-400 text-sm"></i>
                                                </div>
                                                <select name="id_client" id="id_client" required
                                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                    <option value="" disabled selected>Pilih Klien yang
                                                        Mendaftar...</option>
                                                    @foreach ($client as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ old('id_client') == $k->id ? 'selected' : '' }}>
                                                            {{ $k->namapl }} & {{ $k->namapr }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <!-- Jadwal, Lokasi & Pelaksanaan -->
                            <div>
                                <h4
                                    class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-4 px-2 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i> 2. Jadwal, Lokasi & Pelaksanaan
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-2">
                                    <div>
                                        <x-input-label for="tanggal" class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-calendar-check text-amber-500 mr-1"></i> Tanggal Booking
                                            (DP)
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-calendar-day text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="date" id="tanggal" name="tanggal"
                                                value="{{ date('Y-m-d') }}"
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                                required />
                                        </div>
                                    </div>
                                    <div>
                                        <x-input-label for="tanggal_acara"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-rings-wedding text-rose-400 mr-1"></i> Tanggal Acara Utama
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-calendar-alt text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="date" id="tanggal_acara" name="tanggal_acara"
                                                value="{{ date('Y-m-d') }}"
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                                required />
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label for="lokasi_acara"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-map-marker-alt text-indigo-500 mr-1"></i> Lokasi Acara
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-location-dot text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="text" id="lokasi_acara" name="lokasi_acara"
                                                value="{{ old('lokasi_acara', $lokasi_acara ?? '') }}"
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                                required
                                                placeholder="Contoh: Gedung Serba Guna, Jl. Raya No. 123, Kota" />
                                        </div>
                                        <p class="text-[10px] text-gray-500 mt-1 italic">
                                            <i class="fas fa-info-circle mr-1"></i> Masukkan alamat lengkap lokasi
                                            pelaksanaan acara.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Layanan yang Dipesan -->
                            <div class="border-t border-white/30 pt-8 mt-4">
                                <h4
                                    class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-4 px-2 flex items-center">
                                    <i class="fas fa-cubes mr-2"></i> 3. Layanan yang Dipesan
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-2">
                                    <div class="md:col-span-2 lg:col-span-1">
                                        <x-input-label for="id_paket"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-box-open text-emerald-500 mr-1"></i> Pilih Kode Paket
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-tag text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_paket" id="id_paket" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Paket Bundling...
                                                </option>
                                                @foreach ($paket as $p)
                                                    <option value="{{ $p->id }}"
                                                        data-total_harga="{{ $p->total_harga }}">
                                                        {{ $p->kode_paket }} - {{ $p->jenis_paket }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Tagihan & Actions -->
                            <div
                                class="bg-gradient-to-r from-emerald-50/80 to-teal-50/80 backdrop-blur-sm rounded-2xl p-6 border border-white/30 flex flex-col md:flex-row items-center justify-between gap-6 mt-8">

                                <div>
                                    <span
                                        class="block text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1 flex items-center">
                                        <i class="fas fa-calculator mr-1"></i> Total Tagihan (Invoice)
                                    </span>
                                    <div class="flex items-end">
                                        <span class="text-emerald-500 text-xl font-bold mr-2 mb-1">Rp</span>
                                        <input type="text" id="total_harga" readonly
                                            class="bg-transparent border-none text-4xl font-bold text-emerald-700 p-0 m-0 focus:ring-0 w-[250px]"
                                            value="0" placeholder="0">
                                    </div>
                                    <input type="hidden" id="total_bayar" name="total_bayar">
                                </div>

                                <div class="flex items-center gap-3 w-full md:w-auto">
                                    <a href="{{ route('transaksi.index') }}"
                                        class="w-full md:w-auto px-6 py-3 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-all tracking-wide text-center">
                                        <i class="fas fa-arrow-left mr-1"></i> Batal
                                    </a>

                                    @if (Auth::user()->role === 'CLIENT' && empty($myClient))
                                        <button type="button" disabled
                                            class="w-full md:w-auto px-8 py-3 text-sm font-medium text-white bg-gray-400 border border-transparent rounded-full cursor-not-allowed tracking-wide text-center shadow-sm">
                                            <i class="fas fa-lock mr-1"></i> Lengkapi Profil Dulu
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="w-full md:w-auto px-8 py-3 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:ring-4 focus:ring-indigo-500/20 transition-all tracking-wide text-center shadow-md">
                                            <i class="fas fa-save mr-1"></i> Simpan Transaksi
                                        </button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPaket = document.querySelector('#id_paket');
            const displayTotal = document.querySelector('#total_harga');
            const inputTotalHidden = document.querySelector('#total_bayar');

            if (selectPaket) {
                selectPaket.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const harga = parseInt(selectedOption.dataset.total_harga || 0);

                    displayTotal.value = harga.toLocaleString('id-ID');
                    inputTotalHidden.value = harga;
                });

                if (selectPaket.value !== "") {
                    selectPaket.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>

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
