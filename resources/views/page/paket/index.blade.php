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
                    Katalog Paket Wedding
                </h1>
                <p class="text-gray-500 mt-2">Jelajahi dan pilih bundle layanan pernikahan impian Anda</p>
            </div>

            @if (session('success'))
                <div id="alert-success"
                    class="bg-emerald-50/80 backdrop-blur-sm border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg flex items-center justify-between animate-fade-in-down mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 p-2 rounded-full">
                            <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                        </div>
                        <span class="font-medium text-sm tracking-wide">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('alert-success').style.display='none'"
                        class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Main Card -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                </div>
                <div
                    class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">

                    <!-- Header -->
                    <div
                        class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-box text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Daftar Paket</h3>
                                <p class="text-gray-500 text-xs">Bundle layanan pernikahan impian Anda</p>
                            </div>
                        </div>

                        @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                            <div>
                                <a href="{{ route('paket.create') }}"
                                    class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 text-sm shadow-md">
                                    <i class="fas fa-plus mr-2 text-sm"></i>
                                    Tambah Paket Baru
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Tabel Paket -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-600">
                            <thead class="text-xs text-gray-500 uppercase tracking-wider bg-white/30 backdrop-blur-sm">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold w-16 text-center">No</th>
                                    <th scope="col" class="px-6 py-4 font-semibold w-1/3">Profil Paket</th>
                                    <th scope="col" class="px-6 py-4 font-semibold w-1/2">Rincian Fasilitas</th>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center">Harga & Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/30">
                                @forelse ($paket as $key => $p)
                                    <tr
                                        class="bg-white/40 backdrop-blur-sm hover:bg-white/60 transition-all duration-200">
                                        <td
                                            class="px-6 py-6 whitespace-nowrap text-center text-gray-500 font-light align-top">
                                            {{ $paket->perPage() * ($paket->currentPage() - 1) + $key + 1 }}
                                        </td>

                                        <td class="px-6 py-6 align-top">
                                            <div class="flex flex-col gap-3">
                                                <div class="flex-shrink-0 relative group/image cursor-pointer"
                                                    onclick="openImagePreview('{{ asset('storage/' . optional($p->dekorasi)->gambar) }}')">
                                                    @if (optional($p->dekorasi)->gambar)
                                                        <img src="{{ asset('storage/' . $p->dekorasi->gambar) }}"
                                                            alt="Tema Dekorasi"
                                                            class="w-full h-40 object-cover rounded-xl shadow-md border border-white/50 cursor-pointer transition-all duration-300 group-hover/image:brightness-75 group-hover/image:scale-[1.02]">
                                                        <div
                                                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/image:opacity-100 pointer-events-none transition-opacity duration-300">
                                                            <div class="bg-black/50 p-2 rounded-full text-white">
                                                                <i class="fas fa-search text-lg"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="w-full h-40 bg-white/30 backdrop-blur-sm rounded-xl flex flex-col items-center justify-center text-xs text-gray-400 font-light border border-white/30 border-dashed">
                                                            <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                                            Tidak Ada Gambar
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-indigo-100 text-indigo-600 mb-1 tracking-wider uppercase">
                                                        <i class="fas fa-tag mr-1"></i> Kode: {{ $p->kode_paket }}
                                                    </div>
                                                    <h4 class="text-base font-bold text-gray-800">{{ $p->jenis_paket }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-6 align-top">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                                <div>
                                                    <span class="text-xs font-semibold text-gray-800 block mb-0.5">
                                                        <i class="fas fa-flower text-emerald-500 mr-1"></i> Dekorasi
                                                    </span>
                                                    <div class="text-sm text-gray-700 font-medium">
                                                        {{ optional($p->dekorasi)->type_dekorasi ?? '-' }}</div>
                                                    <p class="text-[11px] text-gray-500 line-clamp-2 leading-snug">
                                                        {{ optional($p->dekorasi)->deskripsi ?? '' }}</p>
                                                </div>
                                                <div>
                                                    <span class="text-xs font-semibold text-gray-800 block mb-0.5">
                                                        <i class="fas fa-paint-brush text-rose-400 mr-1"></i> Rias &
                                                        Busana
                                                    </span>
                                                    <div class="text-sm text-gray-700">
                                                        {{ optional($p->makeup)->type_makeup ?? '-' }}</div>
                                                    <div class="text-sm text-gray-700">
                                                        {{ optional($p->wardrobe)->type_wardrobe ?? '-' }}</div>
                                                </div>
                                                <div>
                                                    <span class="text-xs font-semibold text-gray-800 block mb-0.5">
                                                        <i class="fas fa-utensils text-amber-500 mr-1"></i> Catering
                                                    </span>
                                                    <div class="text-sm text-gray-700 font-medium">
                                                        {{ optional($p->catering)->type_catering ?? '-' }}</div>
                                                    <p class="text-[11px] text-gray-500 line-clamp-1 leading-snug">
                                                        {{ optional($p->catering)->deskripsi ?? '' }}</p>
                                                </div>
                                                <div>
                                                    <span class="text-xs font-semibold text-gray-800 block mb-0.5">
                                                        <i class="fas fa-music text-blue-500 mr-1"></i> Hiburan & Vendor
                                                    </span>
                                                    <div class="text-sm text-gray-700">
                                                        {{ optional($p->hiburan)->type_hiburan ?? '-' }}</div>
                                                    <div class="text-sm text-gray-700"><i
                                                            class="fas fa-campground mr-1"></i> Tenda:
                                                        {{ optional($p->tenda)->uk_tenda ?? '-' }}</div>
                                                </div>
                                                <div class="sm:col-span-2 border-t border-white/30 pt-3">
                                                    <span class="text-xs font-semibold text-gray-800 block mb-0.5">
                                                        <i class="fas fa-camera text-indigo-500 mr-1"></i> Dokumentasi
                                                    </span>
                                                    <div class="text-sm text-gray-700">
                                                        {{ optional($p->album)->jenis_album ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-6 align-top text-center border-l border-white/30">
                                            <div class="mb-4">
                                                <span class="block text-xs text-gray-500 uppercase tracking-wider mb-1">
                                                    <i class="fas fa-tag mr-1"></i> Total Harga
                                                </span>
                                                <span class="text-lg font-bold text-emerald-600">
                                                    <i class="fas fa-money-bill-wave text-emerald-500 mr-1"></i>
                                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                                </span>
                                            </div>

                                            @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                                <div
                                                    class="flex flex-col items-center justify-center gap-2 pt-2 border-t border-white/30 mt-4">
                                                    <button type="button" onclick="editSourceModal(this)"
                                                        data-id="{{ $p->id }}"
                                                        data-kode_paket="{{ $p->kode_paket }}"
                                                        data-jenis_paket="{{ $p->jenis_paket }}"
                                                        data-makeup="{{ $p->id_makeup }}"
                                                        data-wardrobe="{{ $p->id_wardrobe }}"
                                                        data-album="{{ $p->id_album }}"
                                                        data-catering="{{ $p->id_catering }}"
                                                        data-tenda="{{ $p->id_tenda }}"
                                                        data-dekorasi="{{ $p->id_dekorasi }}"
                                                        data-hiburan="{{ $p->id_hiburan }}"
                                                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-white/50 backdrop-blur-sm border border-white/50 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl text-xs font-medium tracking-wide transition-all shadow-sm">
                                                        <i class="fas fa-edit mr-2"></i> Edit Paket
                                                    </button>

                                                    <button type="button"
                                                        onclick="paketDelete('{{ $p->id }}', '{{ $p->kode_paket }}')"
                                                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-rose-50/50 backdrop-blur-sm text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-xl text-xs font-medium tracking-wide transition-all shadow-sm">
                                                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            @endif

                                            @if (Auth::user()->role === 'CLIENT')
                                                <div class="mt-4">
                                                    <a href="{{ route('transaksi.create') }}"
                                                        class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 rounded-xl text-xs font-bold tracking-wide transition-all shadow-md shadow-emerald-500/30">
                                                        <i class="fas fa-shopping-cart mr-2"></i> Booking Sekarang
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Belum ada katalog paket yang
                                                    tersedia</p>
                                                <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Paket Baru"
                                                    untuk memulai</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-white/30">
                        {{ $paket->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Edit Paket -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300"
        id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose()"></div>

        <div
            class="relative w-full max-w-5xl bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl mx-4 max-h-[90vh] overflow-y-auto custom-scrollbar transform transition-all border border-white/50">

            <div
                class="flex items-center justify-between px-8 py-5 border-b border-white/30 sticky top-0 bg-white/95 backdrop-blur-sm z-10 rounded-t-2xl">
                <div>
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-edit text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 tracking-wide" id="title_source">Update
                                Komponen Paket</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Ubah rincian fasilitas atau harga yang termasuk
                                dalam paket ini</p>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="sourceModalClose()"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" id="formSourceModal">
                @csrf
                <div class="px-8 py-6 space-y-6">

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white/30 backdrop-blur-sm p-4 rounded-xl border border-white/30">
                        <div>
                            <x-input-label for="modal_kode_paket" value="Kode Paket"
                                class="text-gray-700 font-medium mb-1.5 text-xs" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-barcode text-gray-400 text-sm"></i>
                                </div>
                                <x-text-input type="text" id="modal_kode_paket"
                                    class="block w-full pl-10 bg-gray-100/50 border-white/50 rounded-xl text-sm text-gray-600 cursor-not-allowed font-mono"
                                    readonly />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="modal_jenis_paket" value="Jenis Paket"
                                class="text-gray-700 font-medium mb-1.5 text-xs" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-tag text-gray-400 text-sm"></i>
                                </div>
                                <select id="modal_jenis_paket" name="jenis_paket" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Jenis Paket...</option>
                                    <option value="Wedding">💍 Paket Wedding</option>
                                    <option value="Khitan">🕌 Paket Khitanan</option>
                                    <option value="Engagement">💕 Paket Engagement</option>
                                    <option value="Graduation">🎓 Paket Graduation</option>
                                    <option value="Birthday">🎂 Paket Birthday Party</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="modal_id_makeup" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-paint-brush text-rose-400 mr-1"></i> Makeup
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-palette text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_makeup" id="modal_id_makeup" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Makeup...</option>
                                    @foreach ($makeup as $m)
                                        <option value="{{ $m->id }}" data-harga="{{ $m->harga }}">
                                            {{ $m->type_makeup }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="modal_id_wardrobe" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-tshirt text-indigo-400 mr-1"></i> Wardrobe
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-tshirt text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_wardrobe" id="modal_id_wardrobe" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Wardrobe...</option>
                                    @foreach ($wardrobe as $w)
                                        <option value="{{ $w->id }}" data-harga="{{ $w->harga }}">
                                            {{ $w->type_wardrobe }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="modal_id_dekorasi" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-flower text-emerald-500 mr-1"></i> Dekorasi
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-flower text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_dekorasi" id="modal_id_dekorasi" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Dekorasi...</option>
                                    @foreach ($dekorasi as $d)
                                        <option value="{{ $d->id }}" data-harga="{{ $d->harga }}">
                                            {{ $d->type_dekorasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="modal_id_catering" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-utensils text-amber-500 mr-1"></i> Catering
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-utensils text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_catering" id="modal_id_catering" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Catering...</option>
                                    @foreach ($catering as $c)
                                        <option value="{{ $c->id }}" data-harga="{{ $c->harga }}">
                                            {{ $c->type_catering }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="modal_id_tenda" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-campground text-blue-500 mr-1"></i> Tenda
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-campground text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_tenda" id="modal_id_tenda" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Tenda...</option>
                                    @foreach ($tenda as $t)
                                        <option value="{{ $t->id }}" data-harga="{{ $t->harga_tenda }}">
                                            {{ $t->uk_tenda }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="modal_id_hiburan" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-music text-purple-500 mr-1"></i> Hiburan
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-music text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_hiburan" id="modal_id_hiburan" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Hiburan...</option>
                                    @foreach ($hiburan as $h)
                                        <option value="{{ $h->id }}" data-harga="{{ $h->harga }}">
                                            {{ $h->type_hiburan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <x-input-label for="modal_id_album" class="text-gray-700 font-medium mb-1.5 text-xs">
                                <i class="fas fa-camera text-slate-600 mr-1"></i> Album & Dokumentasi
                            </x-input-label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-camera text-gray-400 text-sm"></i>
                                </div>
                                <select name="id_album" id="modal_id_album" required
                                    class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                    <option value="" disabled>Pilih Album...</option>
                                    @foreach ($album as $a)
                                        <option value="{{ $a->id }}" data-harga="{{ $a->harga }}">
                                            {{ $a->jenis_album }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div
                    class="flex flex-col md:flex-row items-center justify-between px-8 py-5 bg-gradient-to-r from-emerald-50/80 to-teal-50/80 backdrop-blur-sm rounded-b-2xl gap-4 sticky bottom-0 border-t border-white/30">
                    <div>
                        <span class="block text-[10px] font-bold text-emerald-600 uppercase tracking-wider">
                            <i class="fas fa-calculator mr-1"></i> Estimasi Harga Paket
                        </span>
                        <div class="flex items-end">
                            <span class="text-emerald-500 text-lg font-bold mr-1 mb-0.5">Rp</span>
                            <input type="text" id="modal_total_harga_display" readonly
                                class="bg-transparent border-none text-2xl font-bold text-emerald-700 p-0 m-0 focus:ring-0 w-[200px]"
                                value="0">
                        </div>
                        <input type="hidden" id="modal_total_bayar" name="total_harga">
                    </div>

                    <div class="flex gap-3 w-full md:w-auto">
                        <button type="button" onclick="sourceModalClose()"
                            class="flex-1 md:flex-none px-6 py-2.5 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-all">
                            <i class="fas fa-times mr-1"></i> Batal
                        </button>
                        <button type="submit"
                            class="flex-1 md:flex-none px-8 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 transition-all shadow-md">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview Gambar -->
    <div id="imagePreviewModal"
        class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm cursor-pointer" onclick="closeImagePreview()"></div>
        <button onclick="closeImagePreview()" class="absolute top-4 right-4 text-white hover:text-gray-300 p-2 z-10">
            <i class="fas fa-times text-3xl"></i>
        </button>
        <div class="relative z-10 w-11/12 max-w-4xl mx-auto p-4 transform scale-95 transition-transform duration-300"
            id="imagePreviewContainer">
            <img id="previewImage" src="" alt="Preview"
                class="w-full h-auto max-h-[85vh] object-contain rounded-xl shadow-2xl mx-auto">
        </div>
    </div>

    @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
        <script>
            const editSourceModal = (button) => {
                const formModal = document.getElementById('formSourceModal');

                const valJenis = button.dataset.jenis_paket ? button.dataset.jenis_paket.trim() : '';
                const selJenis = document.getElementById('modal_jenis_paket');

                if (valJenis && !Array.from(selJenis.options).some(opt => opt.value === valJenis)) {
                    selJenis.add(new Option(valJenis, valJenis));
                }
                selJenis.value = valJenis;

                document.getElementById('modal_kode_paket').value = button.dataset.kode_paket;
                document.getElementById('modal_id_makeup').value = button.dataset.makeup;
                document.getElementById('modal_id_album').value = button.dataset.album;
                document.getElementById('modal_id_wardrobe').value = button.dataset.wardrobe;
                document.getElementById('modal_id_catering').value = button.dataset.catering;
                document.getElementById('modal_id_tenda').value = button.dataset.tenda;
                document.getElementById('modal_id_dekorasi').value = button.dataset.dekorasi;
                document.getElementById('modal_id_hiburan').value = button.dataset.hiburan;

                formModal.action = `/paket/${button.dataset.id}`;
                formModal.method = 'POST';

                if (!formModal.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    formModal.appendChild(methodInput);
                }

                updateModalTotal();
                document.getElementById('sourceModal').classList.remove('hidden');
            };

            const sourceModalClose = () => {
                document.getElementById('sourceModal').classList.add('hidden');
            };

            const modalElements = [
                document.getElementById('modal_id_album'),
                document.getElementById('modal_id_makeup'),
                document.getElementById('modal_id_catering'),
                document.getElementById('modal_id_wardrobe'),
                document.getElementById('modal_id_dekorasi'),
                document.getElementById('modal_id_hiburan'),
                document.getElementById('modal_id_tenda')
            ];

            const totalDisplay = document.getElementById('modal_total_harga_display');
            const totalInput = document.getElementById('modal_total_bayar');

            function updateModalTotal() {
                let total = 0;
                modalElements.forEach(el => {
                    if (el && el.selectedIndex >= 0) {
                        const opt = el.options[el.selectedIndex];
                        total += parseInt(opt.dataset.harga || 0);
                    }
                });
                totalDisplay.value = total.toLocaleString('id-ID');
                totalInput.value = total;
            }

            modalElements.forEach(el => {
                if (el) el.addEventListener('change', updateModalTotal);
            });

            const paketDelete = (id, kode_paket) => {
                Swal.fire({
                    title: 'Hapus Paket?',
                    html: `Paket dengan kode "<strong>${kode_paket}</strong>" akan dihapus.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#f1f5f9',
                    confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl backdrop-blur-xl bg-white/90',
                        confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                        cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        axios.post(`/paket/${id}`, {
                            '_method': 'DELETE',
                            '_token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }).then(() => location.reload()).catch((error) => {
                            Swal.fire({
                                title: '<i class="fas fa-exclamation-triangle text-rose-500 mr-2"></i> Gagal!',
                                text: 'Terjadi kesalahan.',
                                icon: 'error',
                                customClass: {
                                    popup: 'rounded-2xl'
                                }
                            });
                        });
                    }
                });
            }
        </script>
    @endif

    <script>
        const modalPreview = document.getElementById('imagePreviewModal');
        const containerPreview = document.getElementById('imagePreviewContainer');
        const imgPreview = document.getElementById('previewImage');

        function openImagePreview(imageSrc) {
            if (!imageSrc || imageSrc.includes('null') || imageSrc === 'storage/') {
                return;
            }
            imgPreview.src = imageSrc;
            modalPreview.classList.remove('hidden');
            setTimeout(() => {
                modalPreview.classList.remove('opacity-0');
                containerPreview.classList.remove('scale-95');
                containerPreview.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeImagePreview() {
            modalPreview.classList.add('opacity-0');
            containerPreview.classList.remove('scale-100');
            containerPreview.classList.add('scale-95');
            setTimeout(() => {
                modalPreview.classList.add('hidden');
                imgPreview.src = '';
            }, 300);
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape" && !modalPreview.classList.contains('hidden')) closeImagePreview();
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

        /* Fade In Animation */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
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

        /* Line clamp */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

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
    </style>
</x-app-layout>
