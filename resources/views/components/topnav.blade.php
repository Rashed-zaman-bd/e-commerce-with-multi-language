<nav x-data="{
    open: false,
    language: false,
    accounts: false
}" class="sticky top-0 z-50 bg-white shadow-md">

    <div class="max-w-7xl mx-auto">

        <!-- Top Navbar -->
        <div class="flex items-center justify-between px-1 py-3 gap-3">

            <!-- Left -->
            <div class="flex items-center gap-3">

                 <h1 class="text-base sm:text-base "><i class="bi bi-telephone-fill text-green-600"></i>
                    <span class="text">{{ __('messages.phone_number') }}</span>

                </h1>
               
            </div>

            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-2xl">

                <input type="text"
                    placeholder="{{ __('messages.search_placeholder') }}"
                    class="w-full border border-gray-300 border-r-0 px-4 py-2 outline-none rounded-l-lg">

                <button class="bg-green-500 hover:bg-green-700 text-white px-5 rounded-r-lg">

                    <i class="bi bi-search"></i>
                </button>
            </div>

            <!-- Right -->
            <div class="flex items-center gap-2 sm:gap-4">
               <!-- Language -->
                <div class="relative">

                    <button @click="language = !language"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-2 rounded-lg flex items-center gap-2 text-sm">

                        {{ strtoupper(app()->getLocale()) }}

                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-cloak
                        x-show="language"
                        x-transition
                        @click.outside="language = false"
                        class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border z-50 overflow-hidden">

                        <a href="{{ route('lang.switch', 'bn') }}"
                            class="block px-4 py-2 hover:bg-gray-100">

                            বাংলা
                        </a>

                        <a href="{{ route('lang.switch', 'en') }}"
                            class="block px-4 py-2 hover:bg-gray-100">

                            English
                        </a>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="relative">

                    <button @click="accounts = !accounts"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-2 rounded-lg flex items-center gap-2">

                        <i class="bi bi-person-circle text-xl"></i>

                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-cloak x-show="accounts" x-transition @click.outside="accounts = false"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border z-50 overflow-hidden">

                        <a href="/login" class="block px-4 py-2 hover:bg-gray-100">
                            {{ __('messages.login') }}
                        </a>

                        <a href="/register" class="block px-4 py-2 hover:bg-gray-100">
                            {{ __('messages.register') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay -->
    <div x-cloak x-show="open" class="fixed inset-0 z-50 bg-black/50">

        <!-- Sidebar -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full" class="w-72 h-full bg-white shadow-lg p-5">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-bold">
                    {{ __('messages.menu') }}
                </h2>

                <button @click="open = false" class="text-xl">

                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- Menu -->
            <ul class="space-y-4">

                <li>
                    <a href="/" class="block hover:text-green-600 font-medium">
                        {{ __('messages.home') }}
                    </a>
                </li>

                <li>
                    <a href="/products" class="block hover:text-green-600 font-medium">
                        {{ __('messages.products') }}
                    </a>
                </li>

                <li>
                    <a href="/about" class="block hover:text-green-600 font-medium">
                        {{ __('messages.about') }}
                    </a>
                </li>

                <li>
                    <a href="/contact" class="block hover:text-green-600 font-medium">
                        {{ __('messages.contact') }}
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

