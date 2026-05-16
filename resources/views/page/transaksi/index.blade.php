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
                    @if (Auth::user()->role === 'CLIENT')
                        Riwayat Pesanan Saya
                    @else
                        Daftar Transaksi / Booking
                    @endif
                </h1>
                <p class="text-gray-500 mt-2">Pantau jadwal acara dan status pembayaran</p>
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
                                <i class="fas fa-receipt text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">
                                    @if (Auth::user()->role === 'CLIENT')
                                        Riwayat Pesanan Saya
                                    @else
                                        Seluruh Data Booking
                                    @endif
                                </h3>
                                <p class="text-gray-500 text-xs">Pantau jadwal acara dan status pembayaran</p>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('transaksi.create') }}"
                                class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 text-sm shadow-md">
                                <i class="fas fa-plus mr-2 text-sm"></i>
                                Buat Transaksi Baru
                            </a>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-600 text-sm">
                            <thead class="text-xs text-gray-500 uppercase tracking-wider bg-white/30 backdrop-blur-sm">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center w-16">No</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Invoice & Klien</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Paket & Tanggal</th>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center">Status Transaksi</th>
                                    @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/30">
                                @forelse ($transaksi as $key => $t)
                                    <tr
                                        class="bg-white/40 backdrop-blur-sm hover:bg-white/60 transition-all duration-200">
                                        <td
                                            class="px-6 py-5 whitespace-nowrap text-center text-gray-500 font-light align-top">
                                            {{ $transaksi->perPage() * ($transaksi->currentPage() - 1) + $key + 1 }}
                                        </td>

                                        <td class="px-6 py-5 align-top">
                                            <div
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-600 tracking-wider font-mono mb-2">
                                                <i class="fas fa-hashtag mr-1 text-[8px]"></i>
                                                {{ $t->kode_invoice }}
                                            </div>
                                            <div class="font-semibold text-gray-800">
                                                <i class="fas fa-users text-indigo-500 mr-1 text-xs"></i>
                                                {{ optional($t->client)->namapl }} & {{ optional($t->client)->namapr }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-5 align-top">
                                            <div class="font-medium text-indigo-600 mb-1">
                                                <i class="fas fa-box mr-1"></i>
                                                {{ optional($t->paket)->jenis_paket }}
                                                ({{ optional($t->paket)->kode_paket }})
                                            </div>
                                            <div class="text-xs text-gray-500 mb-0.5">
                                                <i class="far fa-calendar-alt mr-1"></i> Booking:
                                                {{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <i class="fas fa-calendar-check mr-1"></i> Acara:
                                                {{ \Carbon\Carbon::parse($t->tanggal_acara)->format('d M Y') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-5 align-top text-center">
                                            @if (\Carbon\Carbon::parse($t->tanggal_acara)->isPast())
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50/80 backdrop-blur-sm text-emerald-600 mb-2 w-full justify-center">
                                                    <i class="fas fa-check-circle mr-1"></i> Selesai Dikerjakan
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50/80 backdrop-blur-sm text-blue-600 mb-2 w-full justify-center">
                                                    <i class="fas fa-spinner mr-1"></i> {{ $t->status }}
                                                </span>
                                            @endif

                                            @if ($t->pembayaran == 'Lunas')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50/80 backdrop-blur-sm text-emerald-600 w-full justify-center border border-white/30">
                                                    <i class="fas fa-check-circle mr-1 text-[10px]"></i> Lunas
                                                </span>
                                            @elseif($t->pembayaran == 'Dana Pertama')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50/80 backdrop-blur-sm text-amber-600 w-full justify-center border border-white/30">
                                                    <i class="fas fa-hand-holding-usd mr-1 text-[10px]"></i> DP (Dana
                                                    Pertama)
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50/80 backdrop-blur-sm text-amber-600 w-full justify-center border border-white/30">
                                                    <i class="fas fa-clock mr-1 text-[10px]"></i> {{ $t->pembayaran }}
                                                </span>
                                            @endif

                                            <div class="mt-2 text-sm font-bold text-gray-800">
                                                <i class="fas fa-money-bill-wave text-emerald-500 mr-1"></i>
                                                Rp {{ number_format($t->total_bayar, 0, ',', '.') }}
                                            </div>
                                        </td>

                                        @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                            <td class="px-6 py-5 align-top text-center border-l border-white/30">
                                                <div class="flex flex-col items-center justify-center gap-2">
                                                    <button type="button"
                                                        class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                        onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                        data-id="{{ $t->id }}"
                                                        data-invoice="{{ $t->kode_invoice }}"
                                                        data-pembayaran="{{ $t->pembayaran }}"
                                                        data-status="{{ $t->status }}">
                                                        <i class="fas fa-edit mr-1"></i> Update Status
                                                    </button>

                                                    <button type="button"
                                                        class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                        onclick="transaksiDelete('{{ $t->id }}', '{{ addslashes(optional($t->client)->namapl) }}')">
                                                        <i class="fas fa-trash-alt mr-1"></i> Batalkan
                                                    </button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER' ? 5 : 4 }}"
                                            class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                                                    <i class="fas fa-receipt text-gray-400 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Belum ada riwayat transaksi yang
                                                    ditemukan</p>
                                                <p class="text-gray-400 text-sm mt-1">Klik tombol "Buat Transaksi Baru"
                                                    untuk memulai</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-white/30">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Update Status -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300"
        id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose()"></div>

        <div
            class="relative w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl mx-4 transform transition-all border border-white/50">
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent rounded-t-2xl">
                <div>
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-edit text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 tracking-wide" id="title_source">Update Status
                                Pesanan</h3>
                            <p class="text-xs text-gray-500 mt-0.5" id="subtitle_source">Ubah status pengerjaan atau
                                pembayaran</p>
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
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <x-input-label for="status" value="Status Pengerjaan Acara"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-clipboard-list text-gray-400 text-sm"></i>
                            </div>
                            <select name="status" id="status"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                <option value="">Pilih Status...</option>
                                <option value="Baru Booking">📅 Baru Booking</option>
                                <option value="Persiapan">🛠️ Persiapan / Fitting</option>
                                <option value="Selesai">✅ Selesai</option>
                                <option value="Dibatalkan">❌ Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="pembayaran" value="Status Pembayaran (Keuangan)"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-money-bill-wave text-gray-400 text-sm"></i>
                            </div>
                            <select name="pembayaran" id="pembayaran"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all">
                                <option value="">Pilih Status Pembayaran...</option>
                                <option value="Dana Pertama">💰 DP (Dana Pertama)</option>
                                <option value="Termin 2">📋 Termin 2</option>
                                <option value="Lunas">✅ Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-6 py-4 bg-white/30 backdrop-blur-sm rounded-b-2xl gap-3 border-t border-white/30">
                    <button type="button" onclick="sourceModalClose()"
                        class="px-5 py-2 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-colors tracking-wide">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 transition-colors tracking-wide shadow-md">
                        <i class="fas fa-save mr-1"></i> Simpan Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');

        const id = button.dataset.id;
        const invoice = button.dataset.invoice;
        const pembayaran = button.dataset.pembayaran;
        const status = button.dataset.status;

        document.getElementById('subtitle_source').innerHTML =
            `<i class="fas fa-file-invoice mr-1"></i> Invoice: #${invoice}`;

        document.getElementById('pembayaran').value = pembayaran;
        document.getElementById('status').value = status;

        formModal.action = `/transaksi/${id}`;
        formModal.method = 'POST';

        if (!formModal.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            formModal.appendChild(methodInput);
        }

        document.getElementById('sourceModal').classList.remove('hidden');
    }

    const sourceModalClose = () => {
        document.getElementById('sourceModal').classList.add('hidden');
    }

    const transaksiDelete = (id, clientName) => {
        Swal.fire({
            title: 'Batalkan Transaksi?',
            html: `Data booking atas nama <strong>${clientName}</strong> akan dihapus dari sistem.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Batalkan!',
            cancelButtonText: '<i class="fas fa-times mr-1"></i> Tutup',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl backdrop-blur-xl bg-white/90',
                confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                axios.post(`/transaksi/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    })
                    .then(function(response) {
                        Swal.fire({
                            title: '<i class="fas fa-check-circle text-emerald-500 mr-2"></i> Berhasil!',
                            text: 'Transaksi berhasil dibatalkan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: '<i class="fas fa-exclamation-triangle text-rose-500 mr-2"></i> Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                        console.log(error);
                    });
            }
        });
    }
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
</style>
