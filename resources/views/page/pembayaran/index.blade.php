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
                    Tracking Pembayaran
                </h1>
                <p class="text-gray-500 mt-2">Verifikasi pembayaran dari klien dan pantau sisa tagihan</p>
            </div>

            <!-- Filter Status -->
            <div class="mb-6 flex flex-wrap gap-3 justify-center">
                <a href="{{ route('pembayaran.index', ['status' => 'all']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-all shadow-sm {{ request('status') === 'all' || !request('status') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-md' : 'bg-white/50 backdrop-blur-sm text-gray-600 border border-white/50 hover:bg-white/80' }}">
                    <i class="fas fa-list mr-1"></i> Semua Transaksi
                </a>
                <a href="{{ route('pembayaran.index', ['status' => 'Dana Pertama']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-all shadow-sm {{ request('status') == 'Dana Pertama' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'bg-white/50 backdrop-blur-sm text-gray-600 border border-white/50 hover:bg-white/80' }}">
                    <i class="fas fa-hand-holding-usd mr-1"></i> Dana Pertama (DP)
                </a>
                <a href="{{ route('pembayaran.index', ['status' => 'Lunas']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-all shadow-sm {{ request('status') == 'Lunas' ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-md' : 'bg-white/50 backdrop-blur-sm text-gray-600 border border-white/50 hover:bg-white/80' }}">
                    <i class="fas fa-check-circle mr-1"></i> Lunas
                </a>
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
                    <div class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-chart-line text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Monitoring Keuangan</h3>
                                <p class="text-gray-500 text-xs">Verifikasi pembayaran dari klien dan pantau sisa
                                    tagihan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-600 text-sm">
                            <thead class="text-xs text-gray-500 uppercase tracking-wider bg-white/30 backdrop-blur-sm">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center w-16">No</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Invoice & Klien</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Rincian Tagihan</th>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center">Progress Bayar</th>
                                    @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi Verifikasi
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/30">
                                @forelse ($transaksis as $key => $transaksi)
                                    @php
                                        $dibayar = $transaksi->jumlah_dibayar ?? 0;
                                        $total = $transaksi->total_bayar ?? 1;
                                        $persentase = round(($dibayar / $total) * 100);
                                        if ($persentase > 100) {
                                            $persentase = 100;
                                        }
                                        $sisa = $transaksi->total_bayar - $dibayar;
                                    @endphp
                                    <tr
                                        class="bg-white/40 backdrop-blur-sm hover:bg-white/60 transition-all duration-200">
                                        <td
                                            class="px-6 py-5 whitespace-nowrap text-center text-gray-500 font-light align-middle">
                                            {{ $transaksis->perPage() * ($transaksis->currentPage() - 1) + $key + 1 }}
                                        </td>

                                        <td class="px-6 py-5 align-middle">
                                            <div
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-600 tracking-wider font-mono mb-1">
                                                <i class="fas fa-hashtag mr-1 text-[8px]"></i>
                                                {{ $transaksi->kode_invoice }}
                                            </div>
                                            <div class="font-semibold text-gray-800">
                                                <i class="fas fa-user-circle text-indigo-500 mr-1 text-xs"></i>
                                                {{ optional($transaksi->client)->namapl }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-5 align-middle">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-xs text-gray-500">
                                                    <i class="fas fa-tag mr-1"></i> Total:
                                                </span>
                                                <span class="font-medium text-gray-800">
                                                    <i class="fas fa-money-bill-wave text-emerald-500 mr-1"></i>
                                                    Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-xs text-gray-500">
                                                    <i class="fas fa-arrow-down text-emerald-500 mr-1"></i> Masuk:
                                                </span>
                                                <span class="font-medium text-emerald-600">
                                                    Rp {{ number_format($dibayar, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            @if ($sisa > 0)
                                                <div
                                                    class="flex justify-between items-center border-t border-white/30 pt-1 mt-1">
                                                    <span class="text-xs font-medium text-rose-400">
                                                        <i class="fas fa-clock mr-1"></i> Sisa:
                                                    </span>
                                                    <span class="font-bold text-rose-500">
                                                        Rp {{ number_format($sisa, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5 align-middle text-center">
                                            <div
                                                class="w-full bg-white/30 backdrop-blur-sm rounded-full h-4 mb-2 overflow-hidden border border-white/30">
                                                <div class="{{ $persentase == 100 ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : 'bg-gradient-to-r from-amber-500 to-orange-500' }} h-4 rounded-full text-[10px] font-bold text-white flex items-center justify-center transition-all duration-500"
                                                    style="width: {{ $persentase }}%;">
                                                    @if ($persentase > 15)
                                                        {{ $persentase }}%
                                                    @endif
                                                </div>
                                            </div>

                                            @if ($persentase >= 100)
                                                <span class="text-xs font-semibold text-emerald-600">
                                                    <i class="fas fa-check-circle mr-1"></i> Lunas
                                                </span>
                                            @else
                                                <span class="text-xs font-semibold text-amber-600">
                                                    <i class="fas fa-hourglass-half mr-1"></i> Belum Lunas
                                                </span>
                                            @endif
                                        </td>

                                        @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                            <td class="px-6 py-5 align-middle text-center border-l border-white/30">
                                                <button type="button"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white hover:from-indigo-600 hover:to-purple-600 rounded-full text-xs font-medium tracking-wide transition-all shadow-md"
                                                    onclick="openPaymentModal(this)" data-id="{{ $transaksi->id }}"
                                                    data-invoice="{{ $transaksi->kode_invoice }}"
                                                    data-total="{{ $transaksi->total_bayar }}"
                                                    data-dibayar="{{ $dibayar }}">
                                                    <i class="fas fa-coins mr-2"></i> Input Nominal
                                                </button>
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
                                                    <i class="fas fa-chart-line text-gray-400 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Belum ada data transaksi yang
                                                    ditemukan</p>
                                                <p class="text-gray-400 text-sm mt-1">Belum ada transaksi yang tercatat
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-white/30">
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi Pembayaran -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300"
        id="paymentModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closePaymentModal()"></div>

        <div
            class="relative w-full max-w-md bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl mx-4 transform transition-all border border-white/50">
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-money-bill-wave text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 tracking-wide">Verifikasi Pembayaran</h3>
                        <p class="text-xs text-gray-500 mt-0.5" id="modal_subtitle_invoice">Invoice: #---</p>
                    </div>
                </div>
                <button type="button" onclick="closePaymentModal()"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" id="formPaymentModal">
                @csrf
                @method('PATCH')

                <div class="px-6 py-6 space-y-5">

                    <div
                        class="bg-gradient-to-r from-indigo-50/50 to-purple-50/50 backdrop-blur-sm p-4 rounded-xl border border-white/30 flex justify-between items-center">
                        <span class="text-sm text-gray-600 font-medium">
                            <i class="fas fa-receipt mr-1"></i> Total Tagihan:
                        </span>
                        <span class="text-lg font-bold text-gray-800" id="display_total">Rp 0</span>
                    </div>

                    <div>
                        <x-input-label for="jumlah_dibayar" value="Uang yang Masuk / Dibayarkan (Rp)"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-money-bill-wave text-gray-400 text-sm"></i>
                            </div>
                            <x-text-input type="number" id="jumlah_dibayar" name="jumlah_dibayar"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl text-lg font-bold text-emerald-600 focus:border-emerald-500 focus:ring-emerald-500/20 transition-all"
                                required placeholder="0" min="0" />
                        </div>
                        <p class="text-[10px] text-indigo-500 mt-1.5 italic flex items-center">
                            <i class="fas fa-info-circle mr-1 text-xs"></i>
                            *Status akan otomatis berubah menjadi "Lunas" jika nominal mencapai total tagihan.
                        </p>
                    </div>

                </div>

                <div
                    class="flex items-center justify-end px-6 py-4 bg-white/30 backdrop-blur-sm rounded-b-2xl gap-3 border-t border-white/30">
                    <button type="button" onclick="closePaymentModal()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-colors tracking-wide">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-colors tracking-wide shadow-md">
                        <i class="fas fa-save mr-1"></i> Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
<script>
    const openPaymentModal = (button) => {
        const formModal = document.getElementById('formPaymentModal');

        const id = button.dataset.id;
        const invoice = button.dataset.invoice;
        const total = parseInt(button.dataset.total);
        const dibayar = parseInt(button.dataset.dibayar);

        document.getElementById('modal_subtitle_invoice').innerHTML =
            `<i class="fas fa-file-invoice mr-1"></i> Invoice: #${invoice}`;
        document.getElementById('display_total').innerHTML =
            `<i class="fas fa-money-bill-wave mr-1"></i> Rp ${total.toLocaleString('id-ID')}`;

        document.getElementById('jumlah_dibayar').value = dibayar > 0 ? dibayar : '';

        formModal.action = `/pembayaran/${id}/update-status`;

        document.getElementById('paymentModal').classList.remove('hidden');
    }

    const closePaymentModal = () => {
        document.getElementById('paymentModal').classList.add('hidden');
    }

    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
        
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
            0%, 100% {
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
        input:focus, select:focus, textarea:focus {
            outline: none;
        }
    `;
    document.head.appendChild(style);
</script>
