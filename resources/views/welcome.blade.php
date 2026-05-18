<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Citra Wedding Organizer - Wedding Impian Anda</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #db2777, #e11d48);
        }

        /* Glassmorphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-rose-50 via-white to-pink-50 text-gray-700">

    <!-- Navbar Glassmorphism -->
    <nav class="fixed top-0 left-0 w-full z-50 glass shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="font-playfair text-2xl text-rose-500 font-bold flex items-center gap-2">
                <i class="fas fa-ring text-rose-500"></i>
                Citra Wedding
            </a>
            <div class="hidden md:flex gap-6 text-sm font-medium">
                <a href="#tentang" class="hover:text-rose-500 transition-all hover:translate-y-[-2px] inline-block">Tentang</a>
                <a href="#paket" class="hover:text-rose-500 transition-all hover:translate-y-[-2px] inline-block">Paket</a>
                <a href="#testimoni" class="hover:text-rose-500 transition-all hover:translate-y-[-2px] inline-block">Testimoni</a>
                <a href="#lokasi" class="hover:text-rose-500 transition-all hover:translate-y-[-2px] inline-block">Lokasi</a>
                <a href="#kontak" class="hover:text-rose-500 transition-all hover:translate-y-[-2px] inline-block">Kontak</a>
            </div>
            <div class="hidden md:flex gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white px-6 py-2 rounded-full text-sm transition-all shadow-md hover:shadow-lg inline-flex items-center gap-2">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white px-6 py-2 rounded-full text-sm transition-all shadow-md hover:shadow-lg inline-flex items-center gap-2">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endauth
            </div>
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-rose-500 text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden glass border-t border-white/30">
            <div class="flex flex-col p-4 space-y-3">
                <a href="#tentang" class="hover:text-rose-500 transition py-2 px-4 hover:bg-white/30 rounded-lg">Tentang</a>
                <a href="#paket" class="hover:text-rose-500 transition py-2 px-4 hover:bg-white/30 rounded-lg">Paket</a>
                <a href="#testimoni" class="hover:text-rose-500 transition py-2 px-4 hover:bg-white/30 rounded-lg">Testimoni</a>
                <a href="#lokasi" class="hover:text-rose-500 transition py-2 px-4 hover:bg-white/30 rounded-lg">Lokasi</a>
                <a href="#kontak" class="hover:text-rose-500 transition py-2 px-4 hover:bg-white/30 rounded-lg">Kontak</a>
                <hr class="border-white/30">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-rose-500 to-pink-500 text-white px-4 py-2 rounded-full text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-rose-500 to-pink-500 text-white px-4 py-2 rounded-full text-center">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center text-center relative bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1520340356584-5c89c1dbf63a?auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-gradient-to-br from-rose-900/60 via-purple-900/40 to-black/50"></div>
        
        <!-- Floating decorative elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-10 w-40 h-40 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 p-8 md:p-12 glass-card rounded-3xl shadow-2xl max-w-2xl mx-4 animate-fade-up">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-rose-500 to-pink-500 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>
            <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl text-rose-700 mb-4">
                Selamat Datang di <br>Citra Wedding Organizer
            </h1>
            <p class="text-lg md:text-xl font-medium mb-8 text-gray-700">
                Wujudkan momen pernikahan impianmu bersama kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#paket"
                    class="bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white px-8 py-3 rounded-full shadow-lg transition-all inline-flex items-center justify-center gap-2 hover:scale-105">
                    <i class="fas fa-calendar-check"></i> Mulai Sekarang
                </a>
                <a href="#tentang"
                    class="bg-white/20 backdrop-blur-sm border border-white/50 hover:bg-white/30 text-gray-700 px-8 py-3 rounded-full shadow-lg transition-all inline-flex items-center justify-center gap-2">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-20 bg-gradient-to-br from-white to-rose-50">
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl shadow-lg mb-4">
                <i class="fas fa-heart text-white text-xl"></i>
            </div>
            <h2 class="text-3xl font-playfair text-rose-700 mb-4">Tentang Kami</h2>
            <p class="max-w-3xl mx-auto text-base text-gray-600 leading-relaxed">
                Citra Wedding Organizer telah menemani lebih dari <strong class="text-rose-500">500+ pasangan</strong> sejak 2010.
                Kami siap menyulap hari bahagia Anda menjadi momen yang tak terlupakan — mulai dari dekorasi,
                dokumentasi, hingga penyusunan acara secara profesional dengan sentuhan personal yang hangat.
            </p>
            
            <div class="grid md:grid-cols-3 gap-6 mt-10 max-w-4xl mx-auto">
                <div class="glass-card rounded-xl p-4 text-center hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-calendar-alt text-rose-500 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">10+ Tahun Pengalaman</h3>
                    <p class="text-xs text-gray-500">Berpengalaman sejak 2010</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-smile text-rose-500 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">500+ Pasangan Bahagia</h3>
                    <p class="text-xs text-gray-500">Telah melayani banyak klien</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-star text-rose-500 text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Pelayanan Premium</h3>
                    <p class="text-xs text-gray-500">Dengan sentuhan profesional</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Pernikahan Section - UKURAN DIPERKECIL -->
    <section id="paket" class="py-16 bg-gradient-to-br from-rose-50 via-white to-pink-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl shadow-lg mb-4">
                    <i class="fas fa-gift text-white text-xl"></i>
                </div>
                <h2 class="text-3xl font-playfair text-rose-700 mb-2">Paket Pernikahan</h2>
                <p class="text-sm text-gray-500 max-w-2xl mx-auto">Pilih bundle layanan pernikahan impian Anda. Kami
                    menyediakan berbagai pilihan yang disesuaikan dengan kebutuhan hari bahagia Anda.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($paket as $p)
                    <div
                        class="glass-card rounded-xl shadow-md hover:shadow-lg transition-all duration-300 group flex flex-col overflow-hidden hover:-translate-y-1">

                        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-rose-100 to-pink-100">
                            @if (optional($p->dekorasi)->gambar)
                                <img src="{{ asset('storage/' . $p->dekorasi->gambar) }}" alt="{{ $p->jenis_paket }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center">
                                    <i class="fas fa-image text-rose-300 text-4xl mb-2 opacity-50"></i>
                                    <span class="text-xs text-gray-400">Gambar Tersedia Segera</span>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded-full text-[10px] font-bold text-rose-600 tracking-wider shadow-sm">
                                <i class="fas fa-tag mr-1 text-[8px]"></i> {{ $p->kode_paket }}
                            </div>
                            
                            <div class="absolute bottom-3 left-3 bg-rose-500 text-white px-2 py-0.5 rounded-full text-[9px] font-bold">
                                <i class="fas fa-fire text-[8px]"></i> Best Seller
                            </div>
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="text-base font-bold text-rose-600 mb-1">{{ $p->jenis_paket }}</h3>

                            <div class="mt-3 space-y-1.5 mb-4 flex-1">
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-flower text-rose-400 w-4 text-xs"></i>
                                    <span>Dekorasi: {{ optional($p->dekorasi)->type_dekorasi ?? 'Standar' }}</span>
                                </div>
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-paint-brush text-rose-400 w-4 text-xs"></i>
                                    <span>MUA: {{ optional($p->makeup)->type_makeup ?? '-' }}</span>
                                </div>
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-camera text-rose-400 w-4 text-xs"></i>
                                    <span>Dokumentasi: {{ optional($p->album)->jenis_album ?? '-' }}</span>
                                </div>
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-utensils text-rose-400 w-4 text-xs"></i>
                                    <span>Catering: {{ optional($p->catering)->type_catering ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="border-t border-rose-100 pt-3 mt-auto">
                                <p class="text-[10px] text-gray-400 font-semibold tracking-wider uppercase mb-0.5">Total Biaya</p>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-base font-black text-rose-600">Rp
                                            {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                                    </div>

                                    <a href="{{ Auth::check() ? route('transaksi.create') : route('login') }}"
                                        class="px-3 py-1.5 bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-medium rounded-full hover:from-rose-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg inline-flex items-center gap-1">
                                        <i class="fas fa-shopping-cart text-[10px]"></i> Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 glass-card rounded-xl">
                        <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 font-medium">Katalog paket sedang dalam persiapan. Silakan kembali lagi nanti!</p>
                    </div>
                @endforelse
            </div>

            @if (count($paket) > 0)
                <div class="mt-8 text-center">
                    <a href="{{ Auth::check() ? route('transaksi.create') : route('login') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white px-6 py-2.5 rounded-full shadow-lg transition-all hover:scale-105 font-medium text-sm tracking-wide">
                        <i class="fas fa-envelope text-xs"></i> Buat Pesanan Custom
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-gradient-to-br from-white to-rose-50">
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl shadow-lg mb-4">
                <i class="fas fa-quote-right text-white text-xl"></i>
            </div>
            <h2 class="text-3xl font-playfair text-rose-700 mb-8">Apa Kata Mereka?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="glass-card rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="flex justify-center mb-3 gap-0.5">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                    </div>
                    <blockquote class="text-sm text-gray-600 mb-3 leading-relaxed">
                        “Pelayanan Citra Wedding luar biasa! Semua detail diperhatikan, hasilnya sangat memuaskan dan sesuai impian.”
                    </blockquote>
                    <footer class="text-rose-600 font-semibold text-xs">
                        <i class="fas fa-user-circle mr-1"></i> — Anisa & Taufik
                    </footer>
                </div>

                <div class="glass-card rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="flex justify-center mb-3 gap-0.5">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                    </div>
                    <blockquote class="text-sm text-gray-600 mb-3 leading-relaxed">
                        “Timnya sangat profesional dan ramah. Acara pernikahan kami berjalan lancar tanpa kendala. Terima kasih banyak!”
                    </blockquote>
                    <footer class="text-rose-600 font-semibold text-xs">
                        <i class="fas fa-user-circle mr-1"></i> — Rina & Budi
                    </footer>
                </div>

                <div class="glass-card rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="flex justify-center mb-3 gap-0.5">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                    </div>
                    <blockquote class="text-sm text-gray-600 mb-3 leading-relaxed">
                        “Dekorasi dan makeup-nya sangat memukau. Semua keluarga dan tamu memuji konsepnya. Highly recommended!”
                    </blockquote>
                    <footer class="text-rose-600 font-semibold text-xs">
                        <i class="fas fa-user-circle mr-1"></i> — Sari & Doni
                    </footer>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi Section -->
    <section id="lokasi" class="py-16 bg-gradient-to-br from-rose-50 via-white to-pink-50">
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-rose-500 to-pink-500 rounded-xl shadow-lg mb-4">
                <i class="fas fa-map-marker-alt text-white text-xl"></i>
            </div>
            <h2 class="text-3xl font-playfair text-rose-700 mb-2">Lokasi Kami</h2>
            <p class="text-sm text-gray-500 mb-6">Kunjungi kantor kami untuk konsultasi lebih lanjut</p>
            <div class="w-full h-[350px] rounded-xl overflow-hidden shadow-lg border-4 border-white">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311709235512!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-gradient-to-br from-rose-600 to-pink-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl shadow-lg mb-4">
                <i class="fas fa-envelope text-white text-xl"></i>
            </div>
            <h2 class="text-3xl font-playfair mb-5">Hubungi Kami</h2>
            <div class="flex flex-col md:flex-row justify-center gap-5 mt-6">
                <div class="flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm px-5 py-3 rounded-xl">
                    <i class="fas fa-envelope text-xl"></i>
                    <div class="text-left">
                        <p class="text-xs opacity-80">Email</p>
                        <a href="mailto:info@citrawedding.com" class="text-sm font-medium hover:underline">info@citrawedding.com</a>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm px-5 py-3 rounded-xl">
                    <i class="fas fa-phone-alt text-xl"></i>
                    <div class="text-left">
                        <p class="text-xs opacity-80">Telepon</p>
                        <a href="tel:083827148222" class="text-sm font-medium hover:underline">0838-2714-8222</a>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm px-5 py-3 rounded-xl">
                    <i class="fab fa-instagram text-xl"></i>
                    <div class="text-left">
                        <p class="text-xs opacity-80">Instagram</p>
                        <a href="#" class="text-sm font-medium hover:underline">@citrawedding</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-ring text-rose-400 text-sm"></i>
                    <span class="font-playfair font-bold text-sm">Citra Wedding Organizer</span>
                </div>
                <p class="text-xs">&copy; <script>document.write(new Date().getFullYear())</script> Citra Wedding Organizer. All rights reserved.</p>
                <div class="flex gap-3">
                    <a href="#" class="hover:text-rose-400 transition text-sm"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-rose-400 transition text-sm"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-rose-400 transition text-sm"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-rose-400 transition text-sm"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>
</body>

</html>