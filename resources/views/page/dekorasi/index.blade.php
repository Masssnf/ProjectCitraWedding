<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Manajemen Dekorasi') }}
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden lg:col-span-1">
                    <div class="p-6 border-b border-gray-50">
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">Data Dekorasi Baru</h3>
                        <p class="text-xs text-gray-400 font-light mt-1">Tambahkan katalog tema dekorasi.</p>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('dekorasi.store') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="type_dekorasi" value="Tema / Jenis Dekorasi" class="text-gray-600 mb-1.5 text-xs" />
                                <x-text-input type="text" name="type_dekorasi" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20" required placeholder="Contoh: Rustic Minimalis" />
                            </div>
                            
                            <div>
                                <x-input-label for="gambar" value="Foto Referensi" class="text-gray-600 mb-1.5 text-xs" />
                                <input type="file" name="gambar" accept="image/*" 
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 border border-gray-200 rounded-xl transition-colors cursor-pointer" required />
                            </div>

                            <div>
                                <x-input-label for="deskripsi" value="Deskripsi Detail" class="text-gray-600 mb-1.5 text-xs" />
                                <textarea name="deskripsi" rows="3" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 transition-colors resize-none" required placeholder="Lebar pelaminan, jenis bunga, dll..."></textarea>
                            </div>
                            <div>
                                <x-input-label for="harga" value="Harga (Rp)" class="text-gray-600 mb-1.5 text-xs" />
                                <x-text-input type="number" name="harga" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20" required placeholder="5000000" />
                            </div>
                            
                            <div class="pt-3">
                                <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-2.5 bg-zinc-900 border border-transparent rounded-full font-medium text-sm text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 transition-colors tracking-wide">
                                    Simpan Dekorasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden lg:col-span-2">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 tracking-wide">Katalog Dekorasi</h3>
                            <p class="text-xs text-gray-400 font-light mt-1">Daftar layanan dekorasi beserta portofolio gambar.</p>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-400 uppercase tracking-wider bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-medium text-center w-16">No</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Gambar</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Tema Dekorasi</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Detail & Harga</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($dekorasis as $index => $dekorasi)
                                    <tr class="bg-white hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-400 font-light">
                                            {{ ($dekorasis->currentPage() - 1) * $dekorasis->perPage() + $loop->iteration }}
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            @if($dekorasi->gambar)
                                                <img src="{{ asset('storage/' . $dekorasi->gambar) }}" alt="{{ $dekorasi->type_dekorasi }}" class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-100">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex flex-col items-center justify-center text-[10px] text-gray-400 font-light text-center p-2 border border-gray-200 border-dashed">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    No Image
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $dekorasi->type_dekorasi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-gray-500 text-xs font-light mb-1 line-clamp-2 max-w-[12rem]">{{ $dekorasi->deskripsi }}</div>
                                            <div class="font-medium text-emerald-600 mt-1">Rp {{ number_format($dekorasi->harga, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                    onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                    data-id="{{ $dekorasi->id }}" 
                                                    data-type_dekorasi="{{ $dekorasi->type_dekorasi }}" 
                                                    data-deskripsi="{{ $dekorasi->deskripsi }}"
                                                    data-harga="{{ $dekorasi->harga }}">
                                                    Edit
                                                </button>
                                                
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                    onclick="dekorasiDelete('{{ $dekorasi->id }}','{{ addslashes($dekorasi->type_dekorasi) }}')">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-gray-400 font-light">Belum ada paket dekorasi yang terdaftar.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-gray-50">
                        {{ $dekorasis->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300" id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose(this)" data-modal-target="sourceModal"></div>
        
        <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl mx-4 transform transition-all">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-medium text-gray-800 tracking-wide" id="title_source">
                    Update Dekorasi
                </h3>
                <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form method="POST" id="formSourceModal" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <x-input-label for="modal_type_dekorasi" value="Tema Dekorasi" class="text-gray-600 mb-1.5 text-xs" />
                        <x-text-input type="text" id="modal_type_dekorasi" name="type_dekorasi" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20" />
                    </div>
                    
                    <div>
                        <x-input-label for="modal_gambar" value="Ganti Foto (Opsional)" class="text-gray-600 mb-1.5 text-xs" />
                        <input type="file" id="modal_gambar" name="gambar" accept="image/*" 
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 border border-gray-200 rounded-xl transition-colors cursor-pointer" />
                        <p class="text-[10px] text-gray-400 mt-1 italic">*Biarkan kosong jika tidak ingin mengubah gambar saat ini.</p>
                    </div>

                    <div>
                        <x-input-label for="modal_deskripsi" value="Deskripsi" class="text-gray-600 mb-1.5 text-xs" />
                        <textarea id="modal_deskripsi" name="deskripsi" rows="3" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 transition-colors resize-none"></textarea>
                    </div>
                    <div>
                        <x-input-label for="modal_harga" value="Harga (Rp)" class="text-gray-600 mb-1.5 text-xs" />
                        <x-text-input type="number" id="modal_harga" name="harga" class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20" />
                    </div>
                </div>
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50 rounded-b-2xl gap-3">
                    <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-50 transition-colors tracking-wide">
                        Batal
                    </button>
                    <button type="submit" id="formSourceButton"
                        class="px-5 py-2 text-sm font-medium text-white bg-zinc-900 rounded-full hover:bg-zinc-800 transition-colors tracking-wide">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // FUNGSI MEMBUKA MODAL EDIT
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;
        
        const id = button.dataset.id;
        const type_dekorasi = button.dataset.type_dekorasi;
        const deskripsi = button.dataset.deskripsi;
        const harga = button.dataset.harga;
        
        let url = "{{ route('dekorasi.update', ':id') }}".replace(':id', id);

        // Ubah Judul & Isi Input
        document.getElementById('title_source').innerText = `Edit: ${type_dekorasi}`;
        document.getElementById('modal_type_dekorasi').value = type_dekorasi;
        document.getElementById('modal_deskripsi').value = deskripsi;
        document.getElementById('modal_harga').value = harga;
        // Reset file input pada modal agar tidak meninggalkan jejak file sisa sebelumnya
        document.getElementById('modal_gambar').value = '';

        // Atur URL Action Form
        document.getElementById('formSourceModal').setAttribute('action', url);
        
        // Buat atau timpa input _method PATCH
        let methodInput = document.getElementById('method_patch');
        if(!methodInput) {
            methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            methodInput.setAttribute('id', 'method_patch');
            formModal.appendChild(methodInput);
        }

        document.getElementById(modalTarget).classList.remove('hidden');
    }

    // FUNGSI MENUTUP MODAL
    const sourceModalClose = (button) => {
        let targetId = button.getAttribute('data-modal-target');
        if(!targetId) targetId = 'sourceModal'; 
        
        document.getElementById(targetId).classList.add('hidden');
    }

    // FUNGSI HAPUS DENGAN SWEETALERT & AXIOS
    const dekorasiDelete = (id, type_dekorasi) => {
        Swal.fire({
            title: 'Hapus Data?',
            text: `Dekorasi "${type_dekorasi}" akan dihapus permanen!`,
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
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                axios.post(`/dekorasi/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
                .then(function(response) {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Data dekorasi berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: { popup: 'rounded-2xl' }
                    }).then(() => {
                        location.reload(); 
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menghapus data.',
                        icon: 'error',
                        customClass: { popup: 'rounded-2xl' }
                    });
                    console.log(error);
                });
            }
        })
    }
</script>

<style>
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.4s ease-out;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>