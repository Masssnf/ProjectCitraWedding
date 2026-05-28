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

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Welcome Section -->
            <div class="mb-8 text-center">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-rose-600 bg-clip-text text-transparent">
                    Tambah User Baru
                </h1>
                <p class="text-gray-500 mt-2">Lengkapi data di bawah ini untuk mendaftarkan staf atau klien baru ke
                    dalam sistem</p>
            </div>

            <!-- Main Card Glassmorphism -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                </div>
                <div
                    class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">

                    <!-- Header Card -->
                    <div class="px-8 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-user-plus text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Informasi Akun Baru</h3>
                                <p class="text-gray-500 text-xs">Data yang diisi akan digunakan untuk login ke sistem
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="p-8 sm:p-10">
                        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div>
                                <x-input-label for="name" value="Nama Lengkap"
                                    class="text-gray-700 font-medium mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-user text-gray-400 text-sm"></i>
                                    </div>
                                    <x-text-input id="name" type="text" name="name"
                                        class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                        :value="old('name')" required autofocus autocomplete="name"
                                        placeholder="Contoh: Budi Santoso" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" value="Alamat Email"
                                    class="text-gray-700 font-medium mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                    </div>
                                    <x-text-input id="email" type="email" name="email"
                                        class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                        :value="old('email')" required autocomplete="username"
                                        placeholder="budi@example.com" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password & Konfirmasi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                                <div>
                                    <x-input-label for="password" value="Password"
                                        class="text-gray-700 font-medium mb-1.5" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input id="password" type="password" name="password"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required autocomplete="new-password" placeholder="••••••••" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password_confirmations" value="Konfirmasi Password"
                                        class="text-gray-700 font-medium mb-1.5" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-check-circle text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input id="password_confirmations" type="password"
                                            name="password_confirmations"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required autocomplete="new-password" placeholder="••••••••" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmations')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="pt-2">
                                <x-input-label for="role" value="Hak Akses (Role)"
                                    class="text-gray-700 font-medium mb-1.5" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-tag text-gray-400 text-sm"></i>
                                    </div>
                                    <select id="role" name="role" required
                                        class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all appearance-none cursor-pointer">
                                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role
                                            Pengguna...</option>
                                        <option value="ADMIN" {{ old('role') == 'ADMIN' ? 'selected' : '' }}>
                                            <i class="fas fa-shield-alt"></i> ADMIN
                                        </option>
                                        <option value="CLIENT" {{ old('role') == 'CLIENT' ? 'selected' : '' }}>
                                            <i class="fas fa-user"></i> CLIENT
                                        </option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            

                            <!-- Informasi Tambahan -->
                            <div class="bg-indigo-50/50 backdrop-blur-sm rounded-xl p-4 border border-indigo-100">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-indigo-500 mt-0.5"></i>
                                    <div class="text-xs text-indigo-700">
                                        <p class="font-medium mb-1">Informasi:</p>
                                        <p>Password harus terdiri dari minimal 8 karakter untuk keamanan akun.</p>
                                        <p class="mt-1">Pastikan email yang dimasukkan aktif dan valid.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex items-center justify-end gap-3 pt-8 mt-6 border-t border-white/30">
                                <a href="{{ route('users.index') }}"
                                    class="inline-flex items-center px-6 py-2.5 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full font-medium text-sm text-gray-700 hover:bg-white/80 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all tracking-wide">
                                    <i class="fas fa-arrow-left mr-2 text-sm"></i>
                                    {{ __('Batal') }}
                                </a>

                                <button type="submit"
                                    class="inline-flex items-center px-8 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 border border-transparent rounded-full font-medium text-sm text-white hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all tracking-wide shadow-md">
                                    <i class="fas fa-save mr-2 text-sm"></i>
                                    {{ __('Simpan Data') }}
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

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

        /* Menghilangkan underline pada link */
        a {
            text-decoration: none;
        }

        /* Custom focus style for inputs */
        input:focus,
        select:focus {
            outline: none;
        }
    </style>
</x-app-layout>
