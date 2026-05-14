<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Tracking Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex flex-wrap gap-3">
                <a href="{{ route('pembayaran.index', ['status' => 'all']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-colors border {{ request('status') === 'all' || !request('status') ? 'bg-zinc-900 text-white border-zinc-900' : 'bg-white text-gray-500 border-gray-200 hover:bg-gray-50' }}">
                    Semua Transaksi
                </a>
                <a href="{{ route('pembayaran.index', ['status' => 'Dana Pertama']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-colors border {{ request('status') == 'Dana Pertama' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-gray-500 border-gray-200 hover:bg-amber-50' }}">
                    Dana Pertama (DP)
                </a>
                <a href="{{ route('pembayaran.index', ['status' => 'Lunas']) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium tracking-wide transition-colors border {{ request('status') == 'Lunas' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-500 border-gray-200 hover:bg-emerald-50' }}">
                    Lunas
                </a>
            </div>

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
                <div class="p-6 border-b border-gray-50">
                    <h3 class="text-lg font-medium text-gray-800 tracking-wide">Monitoring Keuangan</h3>
                    <p class="text-xs text-gray-400 font-light mt-1">Verifikasi pembayaran dari klien dan pantau sisa tagihan.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-600 text-sm">
                        <thead class="text-xs text-gray-400 uppercase tracking-wider bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-center w-16">No</th>
                                <th scope="col" class="px-6 py-4 font-medium">Invoice & Klien</th>
                                <th scope="col" class="px-6 py-4 font-medium">Rincian Tagihan</th>
                                <th scope="col" class="px-6 py-4 font-medium text-center">Progress Bayar</th>
                                @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                <th scope="col" class="px-6 py-4 font-medium text-center">Aksi Verifikasi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($transaksis as $key => $transaksi)
                                @php
                                    // Menghitung persentase pembayaran dan sisa tagihan
                                    $dibayar = $transaksi->jumlah_dibayar ?? 0;
                                    $total = $transaksi->total_bayar ?? 1; // Cegah devide by zero
                                    $persentase = round(($dibayar / $total) * 100);
                                    if($persentase > 100) $persentase = 100;
                                    $sisa = $transaksi->total_bayar - $dibayar;
                                @endphp
                                <tr class="bg-white hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap text-center text-gray-400 font-light align-middle">
                                        {{ $transaksis->perPage() * ($transaksis->currentPage() - 1) + $key + 1 }}
                                    </td>
                                    
                                    <td class="px-6 py-5 align-middle">
                                        <div class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 tracking-wider font-mono mb-1">
                                            #{{ $transaksi->kode_invoice }}
                                        </div>
                                        <div class="font-medium text-gray-800">{{ optional($transaksi->client)->namapl }}</div>
                                    </td>

                                    <td class="px-6 py-5 align-middle">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs text-gray-400">Total:</span>
                                            <span class="font-medium text-gray-800">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs text-gray-400">Masuk:</span>
                                            <span class="font-medium text-emerald-600">Rp {{ number_format($dibayar, 0, ',', '.') }}</span>
                                        </div>
                                        @if($sisa > 0)
                                            <div class="flex justify-between items-center border-t border-gray-100 pt-1 mt-1">
                                                <span class="text-xs font-medium text-rose-400">Sisa:</span>
                                                <span class="font-bold text-rose-500">Rp {{ number_format($sisa, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5 align-middle text-center">
                                        <div class="w-full bg-gray-100 rounded-full h-4 mb-2 overflow-hidden border border-gray-200">
                                            <div class="{{ $persentase == 100 ? 'bg-emerald-500' : 'bg-amber-400' }} h-4 rounded-full text-[10px] font-bold text-white flex items-center justify-center transition-all duration-500"
                                                style="width: {{ $persentase }}%;">
                                                @if($persentase > 15) {{ $persentase }}% @endif
                                            </div>
                                        </div>
                                        
                                        @if ($persentase >= 100)
                                            <span class="text-xs font-semibold text-emerald-600"><i class="fi fi-sr-check-circle mr-1"></i>Lunas</span>
                                        @else
                                            <span class="text-xs font-semibold text-amber-600">Belum Lunas</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                                    <td class="px-6 py-5 align-middle text-center border-l border-gray-50">
                                        <button type="button"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 text-white hover:bg-zinc-800 rounded-full text-xs font-medium tracking-wide transition-colors shadow-sm"
                                            onclick="openPaymentModal(this)"
                                            data-id="{{ $transaksi->id }}"
                                            data-invoice="{{ $transaksi->kode_invoice }}"
                                            data-total="{{ $transaksi->total_bayar }}"
                                            data-dibayar="{{ $dibayar }}">
                                            <i class="fi fi-sr-coins mr-2"></i> Input Nominal
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-gray-400 font-light">Belum ada data transaksi yang ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-50">
                    {{ $transaksis->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300" id="paymentModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closePaymentModal()"></div>
        
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl mx-4 transform transition-all">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-medium text-gray-800 tracking-wide">Verifikasi Pembayaran</h3>
                    <p class="text-xs text-gray-400 mt-0.5" id="modal_subtitle_invoice">Invoice: #---</p>
                </div>
                <button type="button" onclick="closePaymentModal()"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form method="POST" id="formPaymentModal">
                @csrf
                @method('PATCH')
                
                <div class="px-6 py-6 space-y-5">
                    
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex justify-between items-center">
                        <span class="text-sm text-gray-500 font-medium">Total Tagihan:</span>
                        <span class="text-lg font-bold text-gray-800" id="display_total">Rp 0</span>
                    </div>

                    <div>
                        <x-input-label for="jumlah_dibayar" value="Uang yang Masuk / Dibayarkan (Rp)" class="text-gray-600 mb-1.5 text-xs font-semibold" />
                        <x-text-input type="number" id="jumlah_dibayar" name="jumlah_dibayar" 
                            class="block w-full border-gray-200 rounded-xl text-lg font-bold text-emerald-600 focus:border-emerald-500 focus:ring-emerald-500/20" 
                            required placeholder="0" min="0" />
                        <p class="text-[10px] text-gray-400 mt-1.5 italic">*Status akan otomatis berubah menjadi "Lunas" jika nominal mencapai total tagihan.</p>
                    </div>

                </div>
                
                <div class="flex items-center justify-end px-6 py-4 bg-gray-50 rounded-b-2xl gap-3 border-t border-gray-100">
                    <button type="button" onclick="closePaymentModal()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-50 transition-colors tracking-wide">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-full hover:bg-emerald-700 transition-colors tracking-wide shadow-lg shadow-emerald-500/20">
                        Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // Fungsi Membuka Modal
    const openPaymentModal = (button) => {
        const formModal = document.getElementById('formPaymentModal');
        
        // Ambil data dari tombol
        const id = button.dataset.id;
        const invoice = button.dataset.invoice;
        const total = parseInt(button.dataset.total);
        const dibayar = parseInt(button.dataset.dibayar);

        // Update UI Modal
        document.getElementById('modal_subtitle_invoice').innerText = `Invoice: #${invoice}`;
        document.getElementById('display_total').innerText = `Rp ${total.toLocaleString('id-ID')}`;
        
        // Isi input nominal dengan data yang sudah dibayar sebelumnya (jika ada)
        document.getElementById('jumlah_dibayar').value = dibayar > 0 ? dibayar : '';

        // Atur URL Form Action (Menuju route update-status)
        formModal.action = `/pembayaran/${id}/update-status`; 

        // Tampilkan Modal
        document.getElementById('paymentModal').classList.remove('hidden');
    }

    // Fungsi Menutup Modal
    const closePaymentModal = () => {
        document.getElementById('paymentModal').classList.add('hidden');
    }

    // Animasi muncul
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    `;
    document.head.appendChild(style);
</script>