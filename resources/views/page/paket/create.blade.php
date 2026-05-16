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

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Welcome Section -->
            <div class="mb-8 text-center">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-rose-600 bg-clip-text text-transparent">
                    Rakit Paket Baru
                </h1>
                <p class="text-gray-500 mt-2">Pilih kombinasi layanan untuk membentuk satu paket harga (bundling) bagi
                    klien</p>
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
                                <i class="fas fa-puzzle-piece text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Pembuatan Paket Wedding</h3>
                                <p class="text-gray-500 text-xs">Pilih kombinasi layanan untuk membentuk satu paket
                                    harga (bundling) bagi klien</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 sm:p-10">
                        <form method="POST" action="{{ route('paket.store') }}" class="space-y-8">
                            @csrf

                            <!-- Identitas Paket -->
                            <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                                <h4
                                    class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-4 flex items-center">
                                    <i class="fas fa-tag mr-2"></i> 1. Identitas Paket
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="kode_paket" value="Kode Paket (Otomatis)"
                                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-barcode text-gray-400 text-sm"></i>
                                            </div>
                                            <x-text-input type="text" id="kode_paket" name="kode_paket"
                                                value="{{ $kode_paket }}"
                                                class="block w-full pl-10 bg-gray-100/50 border-white/50 rounded-xl text-sm text-gray-600 cursor-not-allowed font-mono tracking-wider"
                                                readonly required />
                                        </div>
                                    </div>
                                    <div>
                                        <x-input-label for="jenis_paket" value="Jenis Acara / Paket"
                                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-calendar-alt text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="jenis_paket" id="jenis_paket" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Jenis Paket...</option>
                                                <option value="Wedding">💍 Paket Wedding</option>
                                                <option value="Khitan">🕌 Paket Khitanan</option>
                                                <option value="Engagement">💕 Paket Engagement</option>
                                                <option value="Graduation">🎓 Paket Graduation</option>
                                                <option value="Birthday">🎂 Paket Birthday Party</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Komponen & Fasilitas -->
                            <div>
                                <h4
                                    class="text-xs font-semibold text-indigo-600 uppercase tracking-wider mb-4 px-2 flex items-center">
                                    <i class="fas fa-cubes mr-2"></i> 2. Komponen & Fasilitas
                                </h4>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-2">

                                    <!-- Makeup -->
                                    <div>
                                        <x-input-label for="id_makeup" class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-paint-brush text-rose-400 mr-1"></i> Pilihan Make Up
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-palette text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_makeup" id="id_makeup" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Jenis Makeup...</option>
                                                @foreach ($makeup as $m)
                                                    <option value="{{ $m->id }}"
                                                        data-harga="{{ $m->harga }}">{{ $m->type_makeup }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Wardrobe -->
                                    <div>
                                        <x-input-label for="id_wardrobe"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-tshirt text-indigo-400 mr-1"></i> Pilihan Wardrobe
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-tshirt text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_wardrobe" id="id_wardrobe" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Jenis Wardrobe...
                                                </option>
                                                @foreach ($wardrobe as $w)
                                                    <option value="{{ $w->id }}"
                                                        data-harga="{{ $w->harga }}">{{ $w->type_wardrobe }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dekorasi -->
                                    <div>
                                        <x-input-label for="id_dekorasi"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-flower text-emerald-500 mr-1"></i> Tema Dekorasi
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-flower text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_dekorasi" id="id_dekorasi" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Dekorasi...</option>
                                                @foreach ($dekorasi as $d)
                                                    <option value="{{ $d->id }}"
                                                        data-harga="{{ $d->harga }}">{{ $d->type_dekorasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Catering -->
                                    <div>
                                        <x-input-label for="id_catering"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-utensils text-amber-500 mr-1"></i> Pilihan Catering
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-utensils text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_catering" id="id_catering" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Jenis Catering...
                                                </option>
                                                @foreach ($catering as $c)
                                                    <option value="{{ $c->id }}"
                                                        data-harga="{{ $c->harga }}">{{ $c->type_catering }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tenda -->
                                    <div>
                                        <x-input-label for="id_tenda"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-campground text-blue-500 mr-1"></i> Ukuran Tenda
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-campground text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_tenda" id="id_tenda" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Ukuran Tenda...</option>
                                                @foreach ($tenda as $t)
                                                    <option value="{{ $t->id }}"
                                                        data-harga="{{ $t->harga_tenda }}">{{ $t->uk_tenda }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Hiburan -->
                                    <div>
                                        <x-input-label for="id_hiburan"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-music text-purple-500 mr-1"></i> Hiburan / Entertainment
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-music text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_hiburan" id="id_hiburan" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Hiburan...</option>
                                                @foreach ($hiburan as $h)
                                                    <option value="{{ $h->id }}"
                                                        data-harga="{{ $h->harga }}">{{ $h->type_hiburan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Album (Full Width) -->
                                    <div class="md:col-span-3">
                                        <x-input-label for="id_album"
                                            class="text-gray-700 font-medium mb-1.5 text-xs">
                                            <i class="fas fa-camera text-slate-600 mr-1"></i> Dokumentasi & Album
                                        </x-input-label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-camera text-gray-400 text-sm"></i>
                                            </div>
                                            <select name="id_album" id="id_album" required
                                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                                <option value="" disabled selected>Pilih Jenis Dokumentasi...
                                                </option>
                                                @foreach ($album as $a)
                                                    <option value="{{ $a->id }}"
                                                        data-harga="{{ $a->harga }}">{{ $a->jenis_album }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Total Harga & Actions -->
                            <div
                                class="bg-gradient-to-r from-emerald-50/80 to-teal-50/80 backdrop-blur-sm rounded-2xl p-6 border border-white/30 flex flex-col md:flex-row items-center justify-between gap-6 mt-8">

                                <div>
                                    <span
                                        class="block text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1 flex items-center">
                                        <i class="fas fa-calculator mr-1"></i> Estimasi Harga Paket
                                    </span>
                                    <div class="flex items-end">
                                        <span class="text-emerald-500 text-xl font-bold mr-2 mb-1">Rp</span>
                                        <input type="text" id="total_harga_display" readonly
                                            class="bg-transparent border-none text-4xl font-bold text-emerald-700 p-0 m-0 focus:ring-0 w-[250px]"
                                            value="0">
                                    </div>
                                    <input type="hidden" id="total_bayar" name="total_bayar">
                                </div>

                                <div class="flex items-center gap-3 w-full md:w-auto">
                                    <a href="{{ route('paket.index') }}"
                                        class="w-full md:w-auto px-6 py-3 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-all tracking-wide text-center">
                                        <i class="fas fa-arrow-left mr-1"></i> Batal
                                    </a>
                                    <button type="submit"
                                        class="w-full md:w-auto px-8 py-3 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:ring-4 focus:ring-indigo-500/20 transition-all tracking-wide text-center shadow-md">
                                        <i class="fas fa-save mr-1"></i> Simpan Paket
                                    </button>
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
            const album = document.querySelector('#id_album');
            const makeup = document.querySelector('#id_makeup');
            const catering = document.querySelector('#id_catering');
            const wardrobe = document.querySelector('#id_wardrobe');
            const dekorasi = document.querySelector('#id_dekorasi');
            const hiburan = document.querySelector('#id_hiburan');
            const tenda = document.querySelector('#id_tenda');

            const totalHargaDisplay = document.querySelector('#total_harga_display');
            const totalHargaInput = document.querySelector('#total_bayar');

            function updateTotal() {
                const albumHarga = parseInt(album?.selectedOptions[0]?.dataset?.harga || 0);
                const makeupHarga = parseInt(makeup?.selectedOptions[0]?.dataset?.harga || 0);
                const cateringHarga = parseInt(catering?.selectedOptions[0]?.dataset?.harga || 0);
                const wardrobeHarga = parseInt(wardrobe?.selectedOptions[0]?.dataset?.harga || 0);
                const dekorasiHarga = parseInt(dekorasi?.selectedOptions[0]?.dataset?.harga || 0);
                const hiburanHarga = parseInt(hiburan?.selectedOptions[0]?.dataset?.harga || 0);
                const tendaHarga = parseInt(tenda?.selectedOptions[0]?.dataset?.harga || 0);

                const total = albumHarga + makeupHarga + cateringHarga + wardrobeHarga + dekorasiHarga +
                    hiburanHarga + tendaHarga;

                totalHargaDisplay.value = total.toLocaleString('id-ID');
                totalHargaInput.value = total;
            }

            const elements = [album, makeup, catering, wardrobe, dekorasi, hiburan, tenda];
            elements.forEach(el => {
                if (el) el.addEventListener('change', updateTotal);
            });

            updateTotal();
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
