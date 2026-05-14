<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Daftar Transaksi / Booking') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div id="alert-success"
                    class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between animate-fade-in-down mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-sm tracking-wide">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('alert-success').style.display='none'"
                        class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">
                            @if(Auth::user()->role === 'CLIENT')
                                Riwayat Pesanan Saya
                            @else
                                Seluruh Data Booking
                            @endif
                        </h3>
                        <p class="text-xs text-gray-400 font-light mt-1">Pantau jadwal acara dan status pembayaran.</p>
                    </div>

                    <div>
                        <a href="{{ route('transaksi.create') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-zinc-900 rounded-full hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition-all duration-200 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Transaksi Baru
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-600 text-sm">
                        <thead class="text-xs text-gray-400 uppercase tracking-wider bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-medium">Invoice & Klien</th>
                                <th scope="col" class="px-6 py-4 font-medium">Paket & Tanggal</th>
                                <th scope="col" class="px-6 py-4 font-medium text-center">Status Transaksi</th>

                                @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                    <th scope="col" class="px-6 py-4 font-medium text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($transaksi as $key => $t)
                                <tr class="bg-white hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap text-center text-gray-400 font-light align-top">
                                        {{ $transaksi->perPage() * ($transaksi->currentPage() - 1) + $key + 1 }}
                                    </td>

                                    <td class="px-6 py-5 align-top">
                                        <div
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 tracking-wider font-mono mb-2">
                                            #{{ $t->kode_invoice }}
                                        </div>
                                        <div class="font-medium text-gray-800">{{ optional($t->client)->namapl }} &
                                            {{ optional($t->client)->namapr }}</div>
                                    </td>

                                    <td class="px-6 py-5 align-top">
                                        <div class="font-medium text-indigo-600 mb-1">{{ optional($t->paket)->jenis_paket }}
                                            ({{ optional($t->paket)->kode_paket }})</div>
                                        <div class="text-xs text-gray-500 mb-0.5"><span class="font-medium">Booking:</span>
                                            {{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500"><span class="font-medium">Acara:</span>
                                            {{ \Carbon\Carbon::parse($t->tanggal_acara)->format('d M Y') }}</div>
                                    </td>

                                    <td class="px-6 py-5 align-top text-center">
                                        @if (\Carbon\Carbon::parse($t->tanggal_acara)->isPast())
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 mb-2 w-full justify-center">Selesai
                                                Dikerjakan</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600 mb-2 w-full justify-center">{{ $t->status }}</span>
                                        @endif

                                        @if($t->pembayaran == 'Lunas')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 w-full justify-center border border-emerald-100"><i
                                                    class="fi fi-sr-check-circle mr-1 text-[10px]"></i> Lunas</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-600 w-full justify-center border border-amber-100"><i
                                                    class="fi fi-sr-time-fast mr-1 text-[10px]"></i> {{ $t->pembayaran }}</span>
                                        @endif

                                        <div class="mt-2 text-sm font-bold text-gray-800">Rp
                                            {{ number_format($t->total_bayar, 0, ',', '.') }}</div>
                                    </td>

                                    @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                        <td class="px-6 py-5 align-top text-center border-l border-gray-50">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <button type="button"
                                                    class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                    onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                    data-id="{{ $t->id }}" data-invoice="{{ $t->kode_invoice }}"
                                                    data-pembayaran="{{ $t->pembayaran }}" data-status="{{ $t->status }}">
                                                    Update Status
                                                </button>

                                                <button type="button"
                                                    class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                    onclick="transaksiDelete('{{ $t->id }}', '{{ addslashes(optional($t->client)->namapl) }}')">
                                                    Batalkan
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-gray-400 font-light">Belum ada riwayat transaksi yang ditemukan.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-50">
                    {{ $transaksi->links() }}
                </div>
            </div>

        </div>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300"
        id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose()"></div>

        <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl mx-4 transform transition-all">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-medium text-gray-800 tracking-wide" id="title_source">Update Status Pesanan
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5" id="subtitle_source">Ubah status pengerjaan atau pembayaran.
                    </p>
                </div>
                <button type="button" onclick="sourceModalClose()"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" id="formSourceModal">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <x-input-label for="status" value="Status Pengerjaan Acara"
                            class="text-gray-600 mb-1.5 text-xs" />
                        <select name="status" id="status"
                            class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                            <option value="">Pilih Status...</option>
                            <option value="Baru Booking">Baru Booking</option>
                            <option value="Persiapan">Persiapan / Fitting</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="pembayaran" value="Status Pembayaran (Keuangan)"
                            class="text-gray-600 mb-1.5 text-xs" />
                        <select name="pembayaran" id="pembayaran"
                            class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700">
                            <option value="">Pilih Status Pembayaran...</option>
                            <option value="Dana Pertama">DP (Dana Pertama)</option>
                            <option value="Termin 2">Termin 2</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-6 py-4 bg-gray-50 rounded-b-2xl gap-3 border-t border-gray-100">
                    <button type="button" onclick="sourceModalClose()"
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-50 transition-colors tracking-wide">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-zinc-900 rounded-full hover:bg-zinc-800 transition-colors tracking-wide">
                        Simpan Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // FUNGSI MEMBUKA MODAL EDIT STATUS
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');

        const id = button.dataset.id;
        const invoice = button.dataset.invoice;
        const pembayaran = button.dataset.pembayaran;
        const status = button.dataset.status;

        // Ubah teks judul modal agar informatif
        document.getElementById('subtitle_source').innerText = `Invoice: #${invoice}`;

        // Set value combobox
        document.getElementById('pembayaran').value = pembayaran;
        document.getElementById('status').value = status;

        // Atur URL Form Action
        formModal.action = `/transaksi/${id}`;
        formModal.method = 'POST';

        // Sisipkan _method PUT
        if (!formModal.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            formModal.appendChild(methodInput);
        }

        document.getElementById('sourceModal').classList.remove('hidden');
    }

    // FUNGSI MENUTUP MODAL
    const sourceModalClose = () => {
        document.getElementById('sourceModal').classList.add('hidden');
    }

    // FUNGSI HAPUS TRANSAKSI
    const transaksiDelete = (id, clientName) => {
        Swal.fire({
            title: 'Batalkan Transaksi?',
            text: `Data booking atas nama ${clientName} akan dihapus dari sistem.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: '<span class="text-slate-700">Tutup</span>',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                axios.post(`/transaksi/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
                    .then(function (response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Transaksi berhasil dibatalkan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: { popup: 'rounded-2xl' }
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(function (error) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            customClass: { popup: 'rounded-2xl' }
                        });
                        console.log(error);
                    });
            }
        });
    }
</script>

<style>
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
</style>