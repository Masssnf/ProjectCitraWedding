<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Rakit Paket Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">

                    <div class="mb-8 border-b border-gray-50 pb-5">
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">Pembuatan Paket Wedding</h3>
                        <p class="text-sm text-gray-400 font-light mt-1">Pilih kombinasi layanan untuk membentuk satu
                            paket harga (bundling) bagi klien.</p>
                    </div>

                    <form method="POST" action="{{ route('paket.store') }}" class="space-y-8">
                        @csrf

                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">1. Identitas
                                Paket</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="kode_paket" value="Kode Paket (Otomatis)"
                                        class="text-gray-600 mb-1.5 text-xs" />
                                    <x-text-input type="text" id="kode_paket" name="kode_paket"
                                        value="{{ $kode_paket }}"
                                        class="block w-full bg-gray-100 border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed font-mono tracking-wider"
                                        readonly required />
                                </div>
                                <div>
                                    <x-input-label for="jenis_paket" value="Jenis Acara / Paket"
                                        class="text-gray-600 mb-1.5 text-xs" />
                                    <select name="jenis_paket" id="jenis_paket" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white">
                                        <option value="" disabled selected>Pilih Jenis Paket...</option>
                                        <option value="Wedding">Paket Wedding</option>
                                        <option value="Khitan">Paket Khitanan</option>
                                        <option value="Engagement">Paket Engagement</option>
                                        <option value="Graduation">Paket Graduation</option>
                                        <option value="Birthday">Paket Birthday Party</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 px-2">2.
                                Komponen & Fasilitas</h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-2">

                                <div>
                                    <x-input-label for="id_makeup"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-magic-wand text-rose-400 mr-2"></i> Pilihan Make Up
                                    </x-input-label>
                                    <select name="id_makeup" id="id_makeup" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Jenis Makeup...</option>
                                        @foreach ($makeup as $m)
                                            <option value="{{ $m->id }}" data-harga="{{ $m->harga }}">{{ $m->type_makeup }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="id_wardrobe"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-tshirt text-indigo-400 mr-2"></i> Pilihan Wardrobe
                                    </x-input-label>
                                    <select name="id_wardrobe" id="id_wardrobe" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Jenis Wardrobe...</option>
                                        @foreach ($wardrobe as $w)
                                            <option value="{{ $w->id }}" data-harga="{{ $w->harga }}">
                                                {{ $w->type_wardrobe }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="id_dekorasi"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-flower text-emerald-500 mr-2"></i> Tema Dekorasi
                                    </x-input-label>
                                    <select name="id_dekorasi" id="id_dekorasi" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Dekorasi...</option>
                                        @foreach ($dekorasi as $d)
                                            <option value="{{ $d->id }}" data-harga="{{ $d->harga }}">
                                                {{ $d->type_dekorasi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="id_catering"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-room-service text-amber-500 mr-2"></i> Pilihan Catering
                                    </x-input-label>
                                    <select name="id_catering" id="id_catering" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Jenis Catering...</option>
                                        @foreach ($catering as $c)
                                            <option value="{{ $c->id }}" data-harga="{{ $c->harga }}">
                                                {{ $c->type_catering }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="id_tenda"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-home text-blue-500 mr-2"></i> Ukuran Tenda
                                    </x-input-label>
                                    <select name="id_tenda" id="id_tenda" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Ukuran Tenda...</option>
                                        @foreach ($tenda as $t)
                                            <option value="{{ $t->id }}" data-harga="{{ $t->harga_tenda }}">
                                                {{ $t->uk_tenda }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="id_hiburan"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-music-alt text-purple-500 mr-2"></i> Hiburan / Entertainment
                                    </x-input-label>
                                    <select name="id_hiburan" id="id_hiburan" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                                        <option value="" disabled selected>Pilih Hiburan...</option>
                                        @foreach ($hiburan as $h)
                                            <option value="{{ $h->id }}" data-harga="{{ $h->harga }}">{{ $h->type_hiburan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-3 border-t border-gray-100 pt-5 mt-2">
                                    <x-input-label for="id_album"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-camera text-slate-700 mr-2"></i> Dokumentasi & Album
                                    </x-input-label>
                                    <select name="id_album" id="id_album" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white">
                                        <option value="" disabled selected>Pilih Jenis Dokumentasi...</option>
                                        @foreach ($album as $a)
                                            <option value="{{ $a->id }}" data-harga="{{ $a->harga }}">{{ $a->jenis_album }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div
                            class="bg-emerald-50 rounded-2xl p-6 border border-emerald-100 flex flex-col md:flex-row items-center justify-between gap-6 mt-8">

                            <div>
                                <span
                                    class="block text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1">Estimasi
                                    Harga Paket</span>
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
                                    class="w-full md:w-auto px-6 py-3 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-100 transition-colors tracking-wide text-center">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 text-sm font-medium text-white bg-zinc-900 border border-transparent rounded-full hover:bg-zinc-800 focus:ring-4 focus:ring-zinc-900/20 transition-colors tracking-wide text-center shadow-lg shadow-zinc-900/20">
                                    Simpan Paket
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil seluruh elemen select
            const album = document.querySelector('#id_album');
            const makeup = document.querySelector('#id_makeup');
            const catering = document.querySelector('#id_catering');
            const wardrobe = document.querySelector('#id_wardrobe');
            const dekorasi = document.querySelector('#id_dekorasi');
            const hiburan = document.querySelector('#id_hiburan');
            const tenda = document.querySelector('#id_tenda');

            // Ambil elemen display dan input hidden
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

                const total = albumHarga + makeupHarga + cateringHarga + wardrobeHarga + dekorasiHarga + hiburanHarga + tendaHarga;

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
</x-app-layout>