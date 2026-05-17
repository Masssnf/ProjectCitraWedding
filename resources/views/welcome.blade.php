<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Citra Wedding Organizer</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-[#fff8f4] text-gray-700 scroll-smooth">

    <nav class="fixed top-0 left-0 w-full z-50 bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="font-playfair text-2xl text-rose-500 font-bold">Citra Wedding</a>
            <div class="hidden md:flex gap-6 text-sm font-medium">
                <a href="#tentang" class="hover:text-rose-500 transition">About</a>
                <a href="#paket" class="hover:text-rose-500 transition">Paket</a>
                <a href="#testimoni" class="hover:text-rose-500 transition">Testimoni</a>
                <a href="#kontak" class="hover:text-rose-500 transition">Kontak</a>
            </div>
            <div class="hidden md:flex gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-full text-sm transition shadow-md">Dashboard</a>
                @else
                    <a href="/login"
                        class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-full text-sm transition shadow-md">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="h-screen flex items-center justify-center text-center relative bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1520340356584-5c89c1dbf63a?auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-rose-900 bg-opacity-40"></div>
        <div class="relative z-10 p-6 md:p-12 bg-white bg-opacity-80 rounded-lg shadow-xl max-w-xl">
            <h1 class="font-playfair text-4xl md:text-5xl text-rose-700 mb-4">Selamat Datang di Citra Wedding Organizer
            </h1>
            <p class="text-lg md:text-xl font-medium mb-6 text-gray-800">Wujudkan momen pernikahan impianmu bersama
                kami.</p>
            <a href="#paket"
                class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-full shadow transition inline-block">Mulai
                Sekarang</a>
        </div>
    </section>

    <section id="tentang" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-playfair text-rose-700 mb-6">Tentang Kami</h2>
            <p class="max-w-3xl mx-auto text-lg text-gray-700 leading-relaxed">
                Citra Wedding Organizer telah menemani lebih dari <strong>500 pasangan</strong> sejak 2010.
                Kami siap menyulap hari bahagia Anda menjadi momen yang tak terlupakan — mulai dari dekorasi,
                dokumentasi, hingga penyusunan acara secara profesional.
            </p>
        </div>
    </section>

    <section id="paket" class="py-20 bg-[#fff1f2]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-playfair text-rose-700 mb-4">Paket Pernikahan</h2>
                <p class="text-gray-500 font-light max-w-2xl mx-auto">Pilih bundle layanan pernikahan impian Anda. Kami
                    menyediakan berbagai pilihan yang disesuaikan dengan kebutuhan hari bahagia Anda.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($paket as $p)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group flex flex-col border border-rose-50 overflow-hidden">

                        <div class="relative h-56 overflow-hidden bg-gray-100">
                            @if (optional($p->dekorasi)->gambar)
                                <img src="{{ asset('storage/' . $p->dekorasi->gambar) }}" alt="{{ $p->jenis_paket }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center text-rose-300 bg-rose-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-50"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-xs font-light">Gambar Tersedia Segera</span>
                                </div>
                            @endif

                            <div
                                class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-rose-700 tracking-wider shadow-sm">
                                {{ $p->kode_paket }}
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-rose-700 mb-1">{{ $p->jenis_paket }}</h3>

                            <div class="mt-4 space-y-2 mb-6 flex-1">
                                <div class="flex items-start text-sm text-gray-600">
                                    <span class="text-rose-400 mr-2">✿</span>
                                    <span>Dekorasi: {{ optional($p->dekorasi)->type_dekorasi ?? 'Standar' }}</span>
                                </div>
                                <div class="flex items-start text-sm text-gray-600">
                                    <span class="text-rose-400 mr-2">✧</span>
                                    <span>MUA: {{ optional($p->makeup)->type_makeup ?? '-' }}</span>
                                </div>
                                <div class="flex items-start text-sm text-gray-600">
                                    <span class="text-rose-400 mr-2">📷</span>
                                    <span>Dokumentasi: {{ optional($p->album)->jenis_album ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="border-t border-rose-100 pt-5 mt-auto">
                                <p class="text-xs text-gray-400 font-semibold tracking-wider uppercase mb-1">Total Biaya
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-black text-rose-600">Rp
                                        {{ number_format($p->total_harga, 0, ',', '.') }}</span>

                                    <a href="{{ Auth::check() ? route('transaksi.create') : route('login') }}"
                                        class="px-5 py-2 bg-rose-500 text-white text-sm font-medium rounded-full hover:bg-rose-600 transition-colors shadow-md hover:shadow-lg">
                                        Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 bg-white rounded-2xl shadow-sm border border-rose-100">
                        <p class="text-gray-500 font-medium">Katalog paket sedang dalam persiapan. Silakan kembali lagi
                            nanti!</p>
                    </div>
                @endforelse
            </div>

            @if (count($paket) > 0)
                <div class="mt-12 text-center">
                    <a href="{{ Auth::check() ? route('transaksi.create') : route('login') }}"
                        class="bg-rose-600 hover:bg-rose-700 text-white px-8 py-3 rounded-full shadow-lg transition inline-block font-medium tracking-wide">
                        Buat Pesanan Custom
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section id="testimoni" class="py-20 bg-[#ffffff]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-playfair text-rose-700 mb-10">Testimoni</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition border border-gray-50">
                    <blockquote class="text-lg italic text-gray-800 mb-4">
                        “Pelayanan Citra Wedding luar biasa! Semua detail diperhatikan, hasilnya sangat memuaskan dan
                        sesuai impian.”
                    </blockquote>
                    <footer class="text-sm text-rose-600 font-semibold">— Anisa & Taufik</footer>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition border border-gray-50">
                    <blockquote class="text-lg italic text-gray-800 mb-4">
                        “Timnya sangat profesional dan ramah. Acara pernikahan kami berjalan lancar tanpa kendala.
                        Terima kasih banyak!”
                    </blockquote>
                    <footer class="text-sm text-rose-600 font-semibold">— Rina & Budi</footer>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition border border-gray-50">
                    <blockquote class="text-lg italic text-gray-800 mb-4">
                        “Dekorasi dan makeup-nya sangat memukau. Semua keluarga dan tamu memuji konsepnya. Highly
                        recommended!”
                    </blockquote>
                    <footer class="text-sm text-rose-600 font-semibold">— Sari & Doni</footer>
                </div>
            </div>
        </div>
    </section>

    {{-- MAPS --}}
    <section class="py-10 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl font-playfair text-rose-700 mb-4">Lokasi Kami</h2>
            <div class="w-full h-[450px] rounded-xl overflow-hidden shadow-lg">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311709235512!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>


    <section id="kontak" class="py-20 bg-[#fff1f2]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-playfair text-rose-700 mb-6">Hubungi Kami</h2>
            <p class="text-lg mb-2">📧 Email: <a href="mailto:info@citrawedding.com"
                    class="text-rose-500 hover:underline font-medium">info@citrawedding.com</a></p>
            <p class="text-lg">📞 Telp: <a href="tel:083827148222"
                    class="text-rose-500 hover:underline font-medium">0838-2714-8222</a></p>
        </div>
    </section>

    <footer class="bg-rose-600 text-white text-center py-6">
        <div class="container mx-auto px-6">
            ©
            <script>
                document.write(new Date().getFullYear())
            </script> Citra Wedding Organizer. All rights reserved.
        </div>
    </footer>

</body>

</html>
