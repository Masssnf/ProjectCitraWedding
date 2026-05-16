<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-white/30 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-1">

                @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="px-3 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                        <i class="fas fa-tachometer-alt mr-2 text-sm"></i>{{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                        class="px-3 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                        <i class="fas fa-users mr-2 text-sm"></i>{{ __('Data User') }}
                    </x-nav-link>

                    <div class="relative">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none transition-all duration-150">
                                    <i class="fas fa-database mr-2"></i><span>Master Data</span>
                                    <i class="fas fa-chevron-down ms-1 h-3 w-3"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="py-1">
                                    <x-dropdown-link :href="route('client.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-user-friends mr-2 w-4"></i> {{ __('Client') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('wardrobe.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-tshirt mr-2 w-4"></i> {{ __('Wardrobe') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('album.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-image mr-2 w-4"></i> {{ __('Album') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('makeup.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-paint-brush mr-2 w-4"></i> {{ __('Make Up') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('catering.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-utensils mr-2 w-4"></i> {{ __('Catering') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('tenda.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-campground mr-2 w-4"></i> {{ __('Tenda') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('hiburan.index')"
                                        class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-music mr-2 w-4"></i> {{ __('Hiburan') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('dekorasi.index')"
                                        class="hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-palette mr-2 w-4"></i> {{ __('Dekorasi') }}
                                    </x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <x-nav-link :href="route('paket.index')" :active="request()->routeIs('paket.index')"
                    class="px-3 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                    <i class="fas fa-box mr-2 text-sm"></i>{{ __('Paket') }}
                </x-nav-link>

                <div class="relative">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none transition-all duration-150">
                                <i class="fas fa-exchange-alt mr-2"></i><span>Transaksi</span>
                                <i class="fas fa-chevron-down ms-1 h-3 w-3"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="py-1">
                                <x-dropdown-link :href="route('transaksi.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                    <i class="fas fa-calendar-alt mr-2 w-4"></i> {{ __('Booking') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pembayaran.index')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                    <i class="fas fa-money-bill-wave mr-2 w-4"></i> {{ __('Pembayaran') }}
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                    <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')"
                        class="px-3 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                        <i class="fas fa-chart-line mr-2 text-sm"></i>{{ __('Laporan') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Settings Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-indigo-50 transition-all duration-150 focus:outline-none group">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600 text-sm"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">
                                {{ Auth::user()->name }}
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 group-hover:text-indigo-600 text-xs"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1">
                            <div class="px-4 py-2 border-b border-gray-100 mb-1">
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                <p class="text-xs font-medium text-indigo-600 mt-1">{{ Auth::user()->role }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                <i class="fas fa-user-circle mr-2 w-4"></i> {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="hover:bg-rose-50 hover:text-rose-600">
                                    <i class="fas fa-sign-out-alt mr-2 w-4"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition-all duration-150">
                    <i class="fas fa-bars h-5 w-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white/95 backdrop-blur-md border-t border-white/30">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="hover:bg-indigo-50 hover:text-indigo-600">
                <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                    class="hover:bg-indigo-50 hover:text-indigo-600">
                    <i class="fas fa-users mr-2"></i>{{ __('Data User') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('paket.index')" :active="request()->routeIs('paket.index')"
                class="hover:bg-indigo-50 hover:text-indigo-600">
                <i class="fas fa-box mr-2"></i>{{ __('Paket') }}
            </x-responsive-nav-link>
            @if (Auth::user()->role === 'ADMIN' || Auth::user()->role === 'OWNER')
                <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')"
                    class="hover:bg-indigo-50 hover:text-indigo-600">
                    <i class="fas fa-chart-line mr-2"></i>{{ __('Laporan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-gray-100">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="mt-1">
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700">
                        <i class="fas fa-tag mr-1"></i> {{ Auth::user()->role }}
                    </span>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="hover:bg-indigo-50 hover:text-indigo-600">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="hover:bg-rose-50 hover:text-rose-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
