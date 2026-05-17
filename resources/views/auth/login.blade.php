<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Citra Wedding Organizer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>

</head>

<body class="bg-[#fff8f4] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-rose-50">
        
        <h3 class="font-playfair font-bold text-2xl md:text-3xl text-center text-rose-700 mb-2">
            Citra Wedding Organizer
        </h3>
        <p class="text-center text-sm text-gray-500 mb-6">Silakan masuk ke akun Anda</p>

        <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 mb-6 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="h-5 w-5 text-rose-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-rose-800">Belum Punya Akun?</h3>
                    <p class="text-xs text-rose-600 mt-1 leading-relaxed">
                        Untuk pendaftaran profil Klien dan pembuatan akun Login, silakan hubungi <strong>Admin</strong> kami terlebih dahulu melalui kontak WhatsApp yang tersedia di halaman depan.
                    </p>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 transition-colors" />
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 transition-colors" />
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-rose-600 shadow-sm focus:ring-rose-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-8">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-500 hover:text-rose-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif

                <button type="submit"
                    class="ms-3 inline-flex items-center px-6 py-2.5 bg-rose-600 border border-transparent rounded-full font-semibold text-sm text-white hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 shadow-md hover:shadow-lg transition-all">
                    {{ __('Log in') }}
                </button>
            </div>
            
            <div class="mt-6 text-center">
                <a href="/" class="text-xs text-gray-400 hover:text-rose-500 transition-colors">&larr; Kembali ke Beranda</a>
            </div>
        </form>
    </div>

</body>

</html>