<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Citra Wedding Organizer') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="md:col-span-2 lg:col-span-2 lg:row-span-2 bg-zinc-900 rounded-[2rem] p-8 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[280px] group transition-all duration-300 hover:shadow-lg">
                    <div
                        class="absolute top-0 right-0 -mr-12 -mt-12 w-40 h-40 rounded-full bg-zinc-800 opacity-60 blur-3xl transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-zinc-800/80 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V4m0 4h.01m-6.938 4h7.178A2 2 0 0016 12v4a2 2 0 002 2h4v-4a2 2 0 00-2-2H8a2 2 0 00-2 2v4a2 2 0 002 2h7.178A2 2 0 0012 16v-4z" />
                            </svg>
                        </div>
                        <h3 class="text-zinc-400 text-xs font-medium tracking-widest uppercase mb-2">Total Pendapatan
                        </h3>
                    </div>

                    <div class="relative z-10 mt-8">
                        <p class="text-4xl lg:text-5xl font-light text-white tracking-tight">
                            <span
                                class="text-2xl text-zinc-500 font-medium mr-1">Rp</span>{{ number_format($totalPembayaran, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-gray-400 text-xs font-semibold tracking-wider uppercase mb-1">Total Booking</h3>
                        <p class="text-3xl font-light text-gray-800">{{ $totalBooking }}</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-gray-400 text-xs font-semibold tracking-wider uppercase mb-1">Total Client</h3>
                        <p class="text-3xl font-light text-gray-800">{{ $totalClient }}</p>
                    </div>
                </div>

                <div
                    class="md:col-span-2 lg:col-span-2 bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col transition-all duration-300 hover:shadow-md">
                    <h3 class="text-gray-800 text-sm font-medium tracking-wide mb-4 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span> Jadwal Mendatang
                    </h3>

                    <div class="flex-1 overflow-y-auto max-h-[160px] pr-2 custom-scrollbar">
                        @if ($daftarAcara->isEmpty())
                            <div class="h-full flex items-center justify-center text-center">
                                <p class="text-gray-400 text-sm font-light">Belum ada jadwal tersimpan.</p>
                            </div>
                        @else
                            <ul class="space-y-3">
                                @foreach ($daftarAcara as $acara)
                                    <li
                                        class="flex justify-between items-center bg-slate-50/70 rounded-2xl p-3 border border-slate-100/50">
                                        <span class="text-sm font-medium text-slate-700">
                                            {{ optional($acara->client)->namapl ?? 'Client tidak ditemukan' }}
                                        </span>
                                        <span
                                            class="text-xs font-medium px-3 py-1 bg-white text-slate-500 rounded-full shadow-sm">
                                            {{ $acara->formatted_date }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>
</x-app-layout>