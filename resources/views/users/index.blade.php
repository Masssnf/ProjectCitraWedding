<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-gray-800 tracking-widest uppercase leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div id="alert-success"
                    class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between animate-fade-in-down mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-100 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-sm tracking-wide">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('alert-success').style.display='none'"
                        class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 sm:p-8">

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                        <div class="w-full sm:w-auto">
                            <h3 class="text-lg font-medium text-gray-800 tracking-wide">Daftar Pengguna</h3>
                            <p class="text-sm text-gray-400 font-light mt-1">Kelola akses dan peran staf di sistem Citra
                                Wedding.</p>
                        </div>
                        <div class="w-full sm:w-auto flex-none">
                            <a href="{{ route('users.create') }}"
                                class="inline-flex items-center justify-center px-6 py-2.5 font-medium tracking-wide text-white bg-zinc-900 rounded-full hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition-all duration-200 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah User Baru
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-gray-50">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-400 uppercase tracking-wider bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-medium text-center w-16">No</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Email</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-center">Role</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($users as $user)
                                    <tr class="bg-white hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-400 font-light">
                                            {{ ++$i }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-light">{{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium tracking-wide bg-gray-100 text-gray-600">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline-flex items-center gap-2 form-delete">

                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-full text-xs font-medium tracking-wide transition-colors">
                                                    Edit
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="konfirmasiHapus(this)"
                                                    class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                <p class="text-gray-400 font-light">Belum ada data user yang tersedia.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($users->hasPages())
                        <div class="mt-6 border-t border-gray-50 pt-4">
                            {{ $users->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <style>
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function konfirmasiHapus(button) {
            // Mengambil elemen form terdekat dari tombol yang diklik
            const form = button.closest('.form-delete');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data user ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48', // Warna Rose-600 untuk tombol hapus
                cancelButtonColor: '#f1f5f9', // Warna Slate-100 untuk tombol batal
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: '<span class="text-slate-700">Batal</span>',
                reverseButtons: true, // Membalik posisi tombol agar 'Batal' di kiri
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                    cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik 'Ya', submit formnya
                    form.submit();
                }
            })
        }
    </script>
</x-app-layout>