<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">

                    <div class="mb-8 border-b border-gray-50 pb-5">
                        <h3 class="text-lg font-medium text-gray-800 tracking-wide">Informasi Akun Baru</h3>
                        <p class="text-sm text-gray-400 font-light mt-1">Lengkapi data di bawah ini untuk mendaftarkan
                            staf atau klien baru ke dalam sistem.</p>
                    </div>

                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nama Lengkap" class="text-gray-600 mb-1.5" />
                            <x-text-input id="name" type="text" name="name"
                                class="block w-full border-gray-200 rounded-xl shadow-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 text-sm transition-colors"
                                :value="old('name')" required autofocus autocomplete="name"
                                placeholder="Contoh: Budi Santoso" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Alamat Email" class="text-gray-600 mb-1.5" />
                            <x-text-input id="email" type="email" name="email"
                                class="block w-full border-gray-200 rounded-xl shadow-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 text-sm transition-colors"
                                :value="old('email')" required autocomplete="username" placeholder="budi@example.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div>
                                <x-input-label for="password" value="Password" class="text-gray-600 mb-1.5" />
                                <x-text-input id="password" type="password" name="password"
                                    class="block w-full border-gray-200 rounded-xl shadow-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 text-sm transition-colors"
                                    required autocomplete="new-password" placeholder="••••••••" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmations" value="Konfirmasi Password"
                                    class="text-gray-600 mb-1.5" />
                                <x-text-input id="password_confirmations" type="password" name="password_confirmations"
                                    class="block w-full border-gray-200 rounded-xl shadow-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 text-sm transition-colors"
                                    required autocomplete="new-password" placeholder="••••••••" />
                                <x-input-error :messages="$errors->get('password_confirmations')" class="mt-2" />
                            </div>
                        </div>

                        <div class="pt-2">
                            <x-input-label for="role" value="Hak Akses (Role)" class="text-gray-600 mb-1.5" />
                            <div class="relative">
                                <select id="role" name="role" required
                                    class="block w-full border-gray-200 rounded-xl shadow-sm focus:border-zinc-900 focus:ring focus:ring-zinc-900/20 text-gray-700 text-sm transition-colors appearance-none bg-white">
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role Pengguna...
                                    </option>
                                    <option value="ADMIN" {{ old('role') == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                    <option value="CLIENT" {{ old('role') == 'CLIENT' ? 'selected' : '' }}>CLIENT</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-8 mt-6 border-t border-gray-50">
                            <a href="{{ route('users.index') }}"
                                class="inline-flex items-center px-6 py-2.5 bg-white border border-gray-200 rounded-full font-medium text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors tracking-wide">
                                {{ __('Batal') }}
                            </a>

                            <button type="submit"
                                class="inline-flex items-center px-8 py-2.5 bg-zinc-900 border border-transparent rounded-full font-medium text-sm text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 transition-colors tracking-wide">
                                {{ __('Simpan Data') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>