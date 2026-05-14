<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Cetak Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">

                    <div class="mb-8 border-b border-gray-50 pb-5 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-50 rounded-full mb-4">
                            <i class="fi fi-sr-document text-2xl text-emerald-500"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-800 tracking-wide">Laporan Keuangan & Transaksi</h3>
                        <p class="text-sm text-gray-400 font-light mt-2">Pilih rentang waktu (tanggal) untuk mencetak
                            rekapitulasi data booking dan pembayaran.</p>
                    </div>

                    <form method="POST" action="{{ route('laporan.store') }}" target="_blank" class="space-y-6">
                        @csrf

                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="dari"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-calendar text-blue-500 mr-2"></i> Dari Tanggal
                                    </x-input-label>
                                    <x-text-input type="date" id="dari" name="dari" value="{{ date('Y-m-01') }}"
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white"
                                        required />
                                </div>

                                <div>
                                    <x-input-label for="sampai"
                                        class="text-gray-600 mb-1.5 text-xs font-medium flex items-center">
                                        <i class="fi fi-sr-calendar-check text-rose-400 mr-2"></i> Sampai Tanggal
                                    </x-input-label>
                                    <x-text-input type="date" id="sampai" name="sampai" value="{{ date('Y-m-d') }}"
                                        class="block w-full border-gray-200 rounded-xl text-sm focus:border-zinc-900 focus:ring-zinc-900/20 text-gray-700 bg-white"
                                        required />
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-center gap-4 pt-4">
                            <button type="reset"
                                class="w-full md:w-auto px-10 py-3 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full hover:bg-gray-50 transition-colors tracking-wide text-center">
                                Reset Tanggal
                            </button>

                            <button type="submit"
                                class="w-full md:w-auto px-12 py-3 text-sm font-medium text-white bg-zinc-900 border border-transparent rounded-full hover:bg-zinc-800 focus:ring-4 focus:ring-zinc-900/20 transition-colors tracking-wide text-center shadow-lg shadow-zinc-900/20 flex items-center justify-center">
                                <i class="fi fi-sr-print mr-2"></i> Cetak Laporan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>