<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Katalog Paket Wedding') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="alert-success" class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between animate-fade-in-down mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-sm tracking-wide">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('alert-success').style.display='none'" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">Daftar Paket</h3>
                        <p class="text-xs text-gray-400 font-light mt-1">Jelajahi dan pilih bundle layanan pernikahan impian Anda.</p>
                    </div>
                    
                    @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                    <div>
                        <a href="{{ route('paket.create') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-zinc-900 rounded-full hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition-all duration-200 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Paket Baru
                        </a>
                    </div>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-600">
                        <thead class="text-xs text-gray-400 uppercase tracking-wider bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-medium w-1/3">Profil Paket</th>
                                <th scope="col" class="px-6 py-4 font-medium w-1/2">Rincian Fasilitas</th>
                                <th scope="col" class="px-6 py-4 font-medium text-center">Harga & Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($paket as $key => $p)
                                <tr class="bg-white hover:bg-slate-50/30 transition-colors duration-200">
                                    <td class="px-6 py-6 whitespace-nowrap text-center text-gray-400 font-light align-top">
                                        {{ $paket->perPage() * ($paket->currentPage() - 1) + $key + 1 }}
                                    </td>
                                    
                                    <td class="px-6 py-6 align-top">
                                        <div class="flex flex-col gap-3">
                                            <div class="flex-shrink-0 relative group">
                                                @if(optional($p->dekorasi)->gambar)
                                                    <img src="{{ asset('storage/' . $p->dekorasi->gambar) }}" 
                                                         alt="Tema Dekorasi" 
                                                         onclick="openImagePreview('{{ asset('storage/' . $p->dekorasi->gambar) }}')"
                                                         class="w-full h-40 object-cover rounded-xl shadow-sm border border-gray-100 cursor-pointer transition-all duration-300 group-hover:brightness-75 group-hover:scale-[1.02]">
                                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300">
                                                        <div class="bg-black/50 p-2 rounded-full text-white"><i class="fi fi-sr-search-alt text-xl"></i></div>
                                                    </div>
                                                @else
                                                    <div class="w-full h-40 bg-gray-50 rounded-xl flex flex-col items-center justify-center text-[10px] text-gray-400 font-light border border-gray-200 border-dashed">
                                                        <i class="fi fi-sr-picture text-2xl mb-2 text-gray-300"></i> Tidak Ada Gambar
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-600 mb-1 tracking-wider uppercase">
                                                    Kode: {{ $p->kode_paket }}
                                                </div>
                                                <h4 class="text-base font-semibold text-gray-800">{{ $p->jenis_paket }}</h4>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 align-top">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                            <div>
                                                <span class="text-xs font-semibold text-gray-800 block mb-0.5"><i class="fi fi-sr-flower text-emerald-500 mr-1"></i> Dekorasi</span>
                                                <div class="text-sm text-gray-700">{{ optional($p->dekorasi)->type_dekorasi ?? '-' }}</div>
                                                <p class="text-[11px] text-gray-400 line-clamp-2 leading-snug">{{ optional($p->dekorasi)->deskripsi ?? '' }}</p>
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-gray-800 block mb-0.5"><i class="fi fi-sr-magic-wand text-rose-400 mr-1"></i> Rias & Busana</span>
                                                <div class="text-sm text-gray-700">{{ optional($p->makeup)->type_makeup ?? '-' }}</div>
                                                <div class="text-sm text-gray-700">{{ optional($p->wardrobe)->type_wardrobe ?? '-' }}</div>
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-gray-800 block mb-0.5"><i class="fi fi-sr-room-service text-amber-500 mr-1"></i> Catering</span>
                                                <div class="text-sm text-gray-700">{{ optional($p->catering)->type_catering ?? '-' }}</div>
                                                <p class="text-[11px] text-gray-400 line-clamp-1 leading-snug">{{ optional($p->catering)->deskripsi ?? '' }}</p>
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-gray-800 block mb-0.5"><i class="fi fi-sr-music-alt text-blue-500 mr-1"></i> Hiburan & Vendor</span>
                                                <div class="text-sm text-gray-700">{{ optional($p->hiburan)->type_hiburan ?? '-' }}</div>
                                                <div class="text-sm text-gray-700">Tenda: {{ optional($p->tenda)->uk_tenda ?? '-' }}</div>
                                            </div>
                                            <div class="sm:col-span-2 border-t border-gray-50 pt-3">
                                                <span class="text-xs font-semibold text-gray-800 block mb-0.5"><i class="fi fi-sr-camera text-indigo-500 mr-1"></i> Dokumentasi</span>
                                                <div class="text-sm text-gray-700">{{ optional($p->album)->jenis_album ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 align-top text-center border-l border-gray-50">
                                        <div class="mb-4">
                                            <span class="block text-xs text-gray-400 uppercase tracking-wider mb-1">Total Harga</span>
                                            <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                                        </div>

                                        @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                            <div class="flex flex-col items-center justify-center gap-2 pt-2 border-t border-gray-50 mt-4">
                                                
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
                                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-xl text-xs font-medium tracking-wide transition-colors shadow-sm">
                                                    <i class="fi fi-sr-file-edit mr-2"></i> Edit Paket
                                                </button>
                                                
                                                <button type="button" onclick="paketDelete('{{ $p->id }}', '{{ $p->kode_paket }}')"
                                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-xl text-xs font-medium tracking-wide transition-colors shadow-sm">
                                                    <i class="fi fi-sr-delete-document mr-2"></i> Hapus
                                                </button>
                                            </div>
                                        @endif
                                        
                                        @if(Auth::user()->role === 'CLIENT')
                                            <div class="mt-4">
                                                <a href="{{ route('transaksi.create') }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-500 text-white hover:bg-emerald-600 rounded-xl text-xs font-bold tracking-wide transition-colors shadow-sm shadow-emerald-500/30">
                                                    <i class="fi fi-sr-shopping-cart-add mr-2"></i> Booking Sekarang
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-gray-400 font-light">Belum ada katalog paket yang tersedia.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-50">
                    {{ $paket->links() }}
                </div>
            </div>
            
        </div>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300" id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose()"></div>
        
        <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-xl mx-4 max-h-[90vh] overflow-y-auto custom-scrollbar transform transition-all">
            
            <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 sticky top-0 bg-white/95 backdrop-blur-sm z-10">
                <div>
                    <h3 class="text-lg font-medium text-gray-800 tracking-wide" id="title_source">Update Komponen Paket</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Ubah rincian fasilitas atau harga yang termasuk dalam paket ini.</p>
                </div>
                <button type="button" onclick="sourceModalClose()"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" id="formSourceModal">
                @csrf
                <div class="px-8 py-6 space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <div>
                            <x-input-label for="modal_kode_paket" value="Kode Paket" class="text-gray-600 mb-1.5 text-xs" />
                            <x-text-input type="text" id="modal_kode_paket" class="block w-full bg-gray-100 border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed font-mono" readonly />
                        </div>
                        <div>
                            <x-input-label for="modal_jenis_paket" value="Jenis Paket" class="text-gray-600 mb-1.5 text-xs" />
                            <select id="modal_jenis_paket" name="jenis_paket" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 bg-white text-gray-700">
                                <option value="" disabled>Pilih Jenis Paket...</option>
                                <option value="Wedding">Paket Wedding</option>
                                <option value="Khitan">Paket Khitanan</option>
                                <option value="Engagement">Paket Engagement</option>
                                <option value="Graduation">Paket Graduation</option>
                                <option value="Birthday">Paket Birthday Party</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="modal_id_makeup" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-magic-wand text-rose-400 mr-2"></i> Makeup</x-input-label>
                            <select name="id_makeup" id="modal_id_makeup" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Makeup...</option>
                                @foreach ($makeup as $m)
                                    <option value="{{ $m->id }}" data-harga="{{ $m->harga }}">{{ $m->type_makeup }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="modal_id_wardrobe" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-tshirt text-indigo-400 mr-2"></i> Wardrobe</x-input-label>
                            <select name="id_wardrobe" id="modal_id_wardrobe" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Wardrobe...</option>
                                @foreach ($wardrobe as $w)
                                    <option value="{{ $w->id }}" data-harga="{{ $w->harga }}">{{ $w->type_wardrobe }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="modal_id_dekorasi" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-flower text-emerald-500 mr-2"></i> Dekorasi</x-input-label>
                            <select name="id_dekorasi" id="modal_id_dekorasi" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Dekorasi...</option>
                                @foreach ($dekorasi as $d)
                                    <option value="{{ $d->id }}" data-harga="{{ $d->harga }}">{{ $d->type_dekorasi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="modal_id_catering" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-room-service text-amber-500 mr-2"></i> Catering</x-input-label>
                            <select name="id_catering" id="modal_id_catering" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Catering...</option>
                                @foreach ($catering as $c)
                                    <option value="{{ $c->id }}" data-harga="{{ $c->harga }}">{{ $c->type_catering }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="modal_id_tenda" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-home text-blue-500 mr-2"></i> Tenda</x-input-label>
                            <select name="id_tenda" id="modal_id_tenda" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Tenda...</option>
                                @foreach ($tenda as $t)
                                    <option value="{{ $t->id }}" data-harga="{{ $t->harga_tenda }}">{{ $t->uk_tenda }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="modal_id_hiburan" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-music-alt text-purple-500 mr-2"></i> Hiburan</x-input-label>
                            <select name="id_hiburan" id="modal_id_hiburan" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 text-gray-700">
                                <option value="" disabled>Pilih Hiburan...</option>
                                @foreach ($hiburan as $h)
                                    <option value="{{ $h->id }}" data-harga="{{ $h->harga }}">{{ $h->type_hiburan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3 border-t border-gray-100 pt-5 mt-2">
                            <x-input-label for="modal_id_album" class="text-gray-600 mb-1.5 text-xs font-medium"><i class="fi fi-sr-camera text-slate-700 mr-2"></i> Album & Dokumentasi</x-input-label>
                            <select name="id_album" id="modal_id_album" required class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 bg-white text-gray-700">
                                <option value="" disabled>Pilih Album...</option>
                                @foreach ($album as $a)
                                    <option value="{{ $a->id }}" data-harga="{{ $a->harga }}">{{ $a->jenis_album }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                
                <div class="flex flex-col md:flex-row items-center justify-between px-8 py-5 bg-emerald-50 rounded-b-2xl gap-4 sticky bottom-0 border-t border-emerald-100 z-10">
                    <div>
                        <span class="block text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Estimasi Harga Paket</span>
                        <div class="flex items-end">
                            <span class="text-emerald-500 text-lg font-bold mr-1 mb-0.5">Rp</span>
                            <input type="text" id="modal_total_harga_display" readonly class="bg-transparent border-none text-2xl font-bold text-emerald-700 p-0 m-0 focus:ring-0 w-[200px]" value="0">
                        </div>
                        <input type="hidden" id="modal_total_bayar" name="total_harga">
                    </div>

                    <div class="flex gap-3 w-full md:w-auto">
                        <button type="button" onclick="sourceModalClose()" class="flex-1 md:flex-none px-6 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-100 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 md:flex-none px-8 py-2.5 text-sm font-medium text-white bg-zinc-900 rounded-full hover:bg-zinc-800 transition-colors shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="imagePreviewModal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm cursor-pointer" onclick="closeImagePreview()"></div>
        <button onclick="closeImagePreview()" class="absolute top-4 right-4 text-white hover:text-gray-300 p-2 z-10"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
        <div class="relative z-10 w-11/12 max-w-4xl mx-auto p-4 transform scale-95 transition-transform duration-300" id="imagePreviewContainer">
            <img id="previewImage" src="" alt="Preview" class="w-full h-auto max-h-[85vh] object-contain rounded-xl shadow-2xl mx-auto">
        </div>
    </div>

    @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            // 1. FUNGSI BUKA MODAL EDIT PAKET
            const editSourceModal = (button) => {
                const formModal = document.getElementById('formSourceModal');
                
                // --- FIX BUG NULL JENIS PAKET ---
                const valJenis = button.dataset.jenis_paket ? button.dataset.jenis_paket.trim() : '';
                const selJenis = document.getElementById('modal_jenis_paket');
                
                // Pastikan option ada, jika tidak, tambahkan otomatis
                if (valJenis && !Array.from(selJenis.options).some(opt => opt.value === valJenis)) {
                    selJenis.add(new Option(valJenis, valJenis));
                }
                selJenis.value = valJenis;
                // --------------------------------

                document.getElementById('modal_kode_paket').value = button.dataset.kode_paket;
                document.getElementById('modal_id_makeup').value = button.dataset.makeup;
                document.getElementById('modal_id_album').value = button.dataset.album;
                document.getElementById('modal_id_wardrobe').value = button.dataset.wardrobe;
                document.getElementById('modal_id_catering').value = button.dataset.catering;
                document.getElementById('modal_id_tenda').value = button.dataset.tenda;
                document.getElementById('modal_id_dekorasi').value = button.dataset.dekorasi;
                document.getElementById('modal_id_hiburan').value = button.dataset.hiburan;

                // Atur Action form ke route update
                formModal.action = `/paket/${button.dataset.id}`; 
                formModal.method = 'POST';

                // Inject method PUT
                if (!formModal.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    formModal.appendChild(methodInput);
                }

                // Kalkulasi harga agar langsung muncul berdasarkan data yang ditarik
                updateModalTotal();

                // Tampilkan Modal
                document.getElementById('sourceModal').classList.remove('hidden');
            };

            // 2. FUNGSI TUTUP MODAL EDIT
            const sourceModalClose = () => {
                document.getElementById('sourceModal').classList.add('hidden');
            };

            // 3. FUNGSI KALKULASI HARGA DINAMIS DI DALAM MODAL
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

            // 4. FUNGSI DELETE PAKET
            const paketDelete = (id, kode_paket) => {
                Swal.fire({
                    title: 'Hapus Paket?',
                    text: `Paket dengan kode "${kode_paket}" akan dihapus.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48', 
                    cancelButtonColor: '#f1f5f9', 
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: '<span class="text-slate-700">Batal</span>',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                        cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({title: 'Menghapus...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }});
                        axios.post(`/paket/${id}`, {
                            '_method': 'DELETE',
                            '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }).then(() => location.reload()).catch((error) => {
                            Swal.fire({title: 'Gagal!', text: 'Terjadi kesalahan.', icon: 'error', customClass: { popup: 'rounded-2xl' }});
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
        
        document.addEventListener('keydown', (e) => { if (e.key === "Escape" && !modalPreview.classList.contains('hidden')) closeImagePreview(); });
    </script>

    <style>
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
        .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #cbd5e1; }
    </style>
</x-app-layout>