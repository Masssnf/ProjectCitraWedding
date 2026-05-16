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
                    Manajemen Client
                </h1>
                <p class="text-gray-500 mt-2">Kelola data pasangan pengantin di sistem Citra Wedding</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                <!-- Form Tambah Client Card -->
                <div class="relative group lg:col-span-1">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">
                        <div class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-user-plus text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-gray-800 font-bold text-lg">Data Client Baru</h3>
                                    <p class="text-gray-500 text-xs">Tambahkan pasangan pengantin baru</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <form method="POST" action="{{ route('client.store') }}" class="space-y-4">
                                @csrf
                                <div>
                                    <x-input-label for="namapl" value="Nama Pengantin Pria"
                                        class="text-gray-700 font-medium mb-1.5 text-xs" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-male text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input type="text" name="namapl" id="namapl_input"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required placeholder="Contoh: Romeo" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="namapr" value="Nama Pengantin Wanita"
                                        class="text-gray-700 font-medium mb-1.5 text-xs" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-female text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input type="text" name="namapr" id="namapr_input"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required placeholder="Contoh: Juliet" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="alamat" value="Alamat Lengkap"
                                        class="text-gray-700 font-medium mb-1.5 text-xs" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none pt-2">
                                            <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                                        </div>
                                        <textarea name="alamat" rows="3"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all resize-none"
                                            required placeholder="Masukkan alamat domisili..."></textarea>
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="notelp" value="No WhatsApp / Telepon"
                                        class="text-gray-700 font-medium mb-1.5 text-xs" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fab fa-whatsapp text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input type="number" name="notelp"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required placeholder="08123456789" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="email" value="Alamat Email"
                                        class="text-gray-700 font-medium mb-1.5 text-xs" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                        </div>
                                        <x-text-input type="email" name="email"
                                            class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all"
                                            required placeholder="client@email.com" />
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center items-center px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 border border-transparent rounded-full font-medium text-sm text-white hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all tracking-wide shadow-md">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Client
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Daftar Client Card -->
                <div class="relative group lg:col-span-2">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500">
                    </div>
                    <div
                        class="relative bg-white/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-white/50">
                        <div class="px-6 py-5 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-users text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-gray-800 font-bold text-lg">Daftar Client</h3>
                                    <p class="text-gray-500 text-xs">Data pasangan yang telah terdaftar</p>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead
                                    class="text-xs text-gray-500 uppercase tracking-wider bg-white/30 backdrop-blur-sm">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center w-16">No</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Pasangan Pengantin</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Kontak & Alamat</th>
                                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/30">
                                    @forelse ($clients as $index => $client)
                                        <tr
                                            class="bg-white/40 backdrop-blur-sm hover:bg-white/60 transition-all duration-200">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-gray-500 font-light">
                                                {{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-gray-800">
                                                    <i class="fas fa-male text-indigo-500 mr-1"></i>
                                                    {{ $client->namapl }}
                                                </div>
                                                <div class="font-semibold text-gray-800">
                                                    <i class="fas fa-female text-pink-500 mr-1"></i>
                                                    {{ $client->namapr }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-gray-700">
                                                    <i class="fab fa-whatsapp text-green-500 mr-1"></i>
                                                    {{ $client->notelp }}
                                                </div>
                                                <div
                                                    class="text-gray-400 text-xs font-light mt-1 truncate max-w-[200px]">
                                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                                    {{ $client->alamat }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                        onclick="editSourceModal(this)"
                                                        data-modal-target="sourceModal" data-id="{{ $client->id }}"
                                                        data-namapl="{{ $client->namapl }}"
                                                        data-namapr="{{ $client->namapr }}"
                                                        data-alamat="{{ $client->alamat }}"
                                                        data-notelp="{{ $client->notelp }}">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </button>

                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 rounded-full text-xs font-medium tracking-wide transition-colors"
                                                        onclick="clientDelete('{{ $client->id }}','{{ $client->namapl }}','{{ $client->namapr }}')">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div
                                                        class="w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                                                        <i class="fas fa-users-slash text-gray-400 text-3xl"></i>
                                                    </div>
                                                    <p class="text-gray-500 font-medium">Belum ada data client yang
                                                        terdaftar</p>
                                                    <p class="text-gray-400 text-sm mt-1">Klik form di samping untuk
                                                        menambahkan client</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-white/30">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Edit Client -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300"
        id="sourceModal">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="sourceModalClose(this)"
            data-modal-target="sourceModal"></div>

        <div
            class="relative w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl mx-4 transform transition-all border border-white/50">
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-white/30 bg-gradient-to-r from-white/30 to-transparent rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-user-edit text-white text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 tracking-wide" id="title_source">
                        Update Data Client
                    </h3>
                </div>
                <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                    class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form method="POST" id="formSourceModal">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <x-input-label for="namapl" value="Nama Pengantin Pria"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-male text-gray-400 text-sm"></i>
                            </div>
                            <x-text-input type="text" id="modal_namapl" name="namapl"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="namapr" value="Nama Pengantin Wanita"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-female text-gray-400 text-sm"></i>
                            </div>
                            <x-text-input type="text" id="modal_namapr" name="namapr"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="alamat" value="Alamat Lengkap"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none pt-2">
                                <i class="fas fa-map-marker-alt text-gray-400 text-sm"></i>
                            </div>
                            <x-text-input type="text" id="modal_alamat" name="alamat"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="notelp" value="No Telepon"
                            class="text-gray-700 font-medium mb-1.5 text-xs" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fab fa-whatsapp text-gray-400 text-sm"></i>
                            </div>
                            <x-text-input type="text" id="modal_notelp" name="notelp"
                                class="block w-full pl-10 border-white/50 bg-white/50 backdrop-blur-sm rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 text-gray-700 text-sm transition-all" />
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-6 py-4 bg-white/30 backdrop-blur-sm rounded-b-2xl gap-3 border-t border-white/30">
                    <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                        class="px-5 py-2 text-sm font-medium text-gray-700 bg-white/50 backdrop-blur-sm border border-white/50 rounded-full hover:bg-white/80 transition-colors tracking-wide">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" id="formSourceButton"
                        class="px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full hover:from-indigo-600 hover:to-purple-600 transition-colors tracking-wide shadow-md">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<script>
    // FUNGSI MEMBUKA MODAL EDIT
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;

        // Ambil data
        const id = button.dataset.id;
        const namapl = button.dataset.namapl;
        const namapr = button.dataset.namapr;
        const alamat = button.dataset.alamat;
        const notelp = button.dataset.notelp;

        // Set URL Action
        let url = "{{ route('client.update', ':id') }}".replace(':id', id);

        // Ubah Judul & Isi Input
        document.getElementById('title_source').innerHTML =
            `<i class="fas fa-user-edit mr-2"></i> Edit: ${namapl} & ${namapr}`;
        document.getElementById('modal_namapl').value = namapl;
        document.getElementById('modal_namapr').value = namapr;
        document.getElementById('modal_alamat').value = alamat;
        document.getElementById('modal_notelp').value = notelp;

        // Atur Form Atribut
        document.getElementById('formSourceModal').setAttribute('action', url);

        // Buat atau timpa input _method PATCH (Karena ini Edit)
        let methodInput = document.getElementById('method_patch');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            methodInput.setAttribute('id', 'method_patch');
            formModal.appendChild(methodInput);
        }

        // Tampilkan Modal
        document.getElementById(modalTarget).classList.remove('hidden');
    }

    // FUNGSI MENUTUP MODAL
    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        document.getElementById(modalTarget).classList.add('hidden');
    }

    // FUNGSI HAPUS DENGAN SWEETALERT & AXIOS
    const clientDelete = (id, namapl, namapr) => {
        Swal.fire({
            title: 'Hapus Client?',
            html: `Data pasangan <strong>${namapl} & ${namapr}</strong> akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl backdrop-blur-xl bg-white/90',
                confirmButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide',
                cancelButton: 'rounded-full px-6 py-2.5 text-sm font-medium tracking-wide border-none shadow-none',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                axios.post(`/client/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    })
                    .then(function(response) {
                        Swal.fire({
                            title: '<i class="fas fa-check-circle text-emerald-500 mr-2"></i> Terhapus!',
                            text: 'Data client berhasil dihapus.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: '<i class="fas fa-exclamation-triangle text-rose-500 mr-2"></i> Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                        console.log(error);
                    });
            }
        })
    }
</script>

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

    /* Custom focus style for inputs */
    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
    }
</style>
