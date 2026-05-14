<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Form Booking Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">
                    
                    <div class="mb-8 border-b border-gray-50 pb-5">
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">Buat Transaksi / Booking</h3>
                        <p class="text-sm text-gray-400 font-light mt-1">Catat pesanan layanan wedding, tentukan jadwal acara, dan pilih paket yang sesuai.</p>
                    </div>

                    <form method="POST" action="{{ route('transaksi.store') }}" class="space-y-8">
                        @csrf
                        
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">1. Identitas Transaksi & Klien</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <x-input-label for="kode_invoice" value="Kode Invoice (Otomatis)" class="text-gray-600 mb-1.5 text-xs" />
                                    <x-text-input type="text" id="kode_invoice" name="kode_invoice" value="{{ $kode_invoice }}"
                                        class="block w-full bg-gray-100 border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed font-mono tracking-wider"
                                        readonly required />
                                </div>
                                
                                <div>
                                    <x-input-label for="id_client" class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-users-alt text-blue-400 mr-2"></i> Klien / Pemesan
                                    </x-input-label>

                                    @if(Auth::user()->role === 'CLIENT')
                                        @php
                                            // Asumsi: Tabel 'clients' memiliki kolom 'id_user' yang terhubung dengan tabel 'users'
                                            // Jika nama kolom Anda berbeda (misal 'user_id'), silakan ubah kata 'id_user' di bawah ini
                                            $myClient = $client->where('id_user', Auth::id())->first();
                                        @endphp
                                        
                                        <input type="hidden" name="id_client" value="{{ $myClient->id ?? '' }}">
                                        
                                        <x-text-input type="text" 
                                            value="{{ $myClient ? $myClient->namapl . ' & ' . $myClient->namapr : Auth::user()->name }}"
                                            class="block w-full bg-gray-100 border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed font-medium"
                                            readonly required />
                                            
                                        <p class="text-[10px] text-gray-400 mt-1 italic">*Booking akan tercatat atas nama Anda.</p>
                                    @else
                                        <select name="id_client" id="id_client" required
                                            class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white">
                                            <option value="" disabled selected>Pilih Klien yang Mendaftar...</option>
                                            @foreach ($client as $k)
                                                <option value="{{ $k->id }}" {{ old('id_client') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->namapl }} & {{ $k->namapr }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 px-2">2. Jadwal & Pelaksanaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-2">
                                <div>
                                    <x-input-label for="tanggal" class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-calendar-check text-amber-500 mr-2"></i> Tanggal Booking (DP)
                                    </x-input-label>
                                    <x-text-input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}"
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700" required />
                                </div>
                                <div>
                                    <x-input-label for="tanggal_acara" class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-rings-wedding text-rose-400 mr-2"></i> Tanggal Acara Utama
                                    </x-input-label>
                                    <x-text-input type="date" id="tanggal_acara" name="tanggal_acara" value="{{ date('Y-m-d') }}"
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700" required />
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-50 pt-8 mt-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 px-2">3. Layanan yang Dipesan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-2">
                                <div class="md:col-span-2 lg:col-span-1">
                                    <x-input-label for="id_paket" class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-box-open text-emerald-500 mr-2"></i> Pilih Kode Paket
                                    </x-input-label>
                                    <select name="id_paket" id="id_paket" required
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white">
                                        <option value="" disabled selected>Pilih Paket Bundling...</option>
                                        @foreach ($paket as $p)
                                            <option value="{{ $p->id }}" data-total_harga="{{ $p->total_harga }}">
                                                {{ $p->kode_paket }} - {{ $p->jenis_paket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="hidden lg:block"></div>
                            </div>
                        </div>

                        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-100 flex flex-col md:flex-row items-center justify-between gap-6 mt-8">
                            
                            <div>
                                <span class="block text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1">Total Tagihan (Invoice)</span>
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
                                    class="w-full md:w-auto px-6 py-3 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-100 transition-colors tracking-wide text-center">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 text-sm font-medium text-white bg-zinc-900 border border-transparent rounded-full hover:bg-zinc-800 focus:ring-4 focus:ring-zinc-900/20 transition-colors tracking-wide text-center shadow-lg shadow-zinc-900/20">
                                    Simpan Transaksi
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPaket = document.querySelector('#id_paket'); 
            const displayTotal = document.querySelector('#total_harga'); 
            const inputTotalHidden = document.querySelector('#total_bayar'); 

            selectPaket.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = parseInt(selectedOption.dataset.total_harga || 0);

                displayTotal.value = harga.toLocaleString('id-ID');
                inputTotalHidden.value = harga;
            });
            
            // Memastikan ulang nilai jika refresh
            if(selectPaket.value !== "") {
                selectPaket.dispatchEvent(new Event('change'));
            }
        });
    </script>

</x-app-layout>