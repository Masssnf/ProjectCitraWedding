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
                    Manajemen User
                </h1>
                <p class="text-gray-500 mt-2">Kelola akses dan peran staf di sistem Citra Wedding</p>
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

            <!-- Main Card Glassmorphism -->
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                </div>
                <div
                    class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">

                    <!-- Header Card -->
                    <div
                        class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-users text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-bold text-lg">Daftar Pengguna</h3>
                                <p class="text-gray-500 text-xs">Kelola akses dan peran staf di sistem Citra Wedding</p>
                            </div>
                        </div>
                        <a href="{{ route('users.create') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 text-sm shadow-md">
                            <i class="fas fa-user-plus mr-2 text-sm"></i>
                            Tambah User Baru
                        </a>
                    </div>

                    <!-- Tabel -->
                    <div class="p-6">
                        <div class="overflow-x-auto rounded-xl">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead
                                    class="text-xs text-gray-500 uppercase tracking-wider bg-white/30 backdrop-blur-sm">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center w-16">No</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Nama Lengkap</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Email</th>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Role</th>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/30">
                                    @forelse($users as $user)
                                        <tr
                                            class="bg-white/40 backdrop-blur-sm hover:bg-white/60 transition-all duration-200">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-gray-500 font-light">
                                                {{ ++$i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-800">
                                                <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-light">
                                                <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium tracking-wide bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700">
                                                    @if ($user->role == 'ADMIN')
                                                        <i class="fas fa-shield-alt mr-1 text-xs"></i>
                                                    @elseif($user->role == 'OWNER')
                                                        <i class="fas fa-crown mr-1 text-xs"></i>
                                                    @else
                                                        <i class="fas fa-user mr-1 text-xs"></i>
                                                    @endif
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="inline-flex items-center gap-2 form-delete">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 rounded-full text-xs font-medium tracking-wide transition-colors">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Edit
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="konfirmasiHapus(this)"
                                                        class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors">
                                                        <i class="fas fa-trash-alt mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                                                        <i class="fas fa-users-slash text-gray-400 text-3xl"></i>
                                                    </div>
                                                    <p class="text-gray-500 font-medium">Belum ada data user yang
                                                        tersedia</p>
                                                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah User
                                                        Baru" untuk memulai</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($users->hasPages())
                            <div class="mt-6 border-t border-white/30 pt-4">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>

    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.8);
        }

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

        /* Fade In Animation */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
        }

        /* Menghilangkan underline pada link */
        a {
            text-decoration: none;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function konfirmasiHapus(button) {
            const form = button.closest('.form-delete');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data user ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: '<span class="text-slate-700">Batal</span>',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl backdrop-blur-xl bg-white/90',
                    confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                    cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
