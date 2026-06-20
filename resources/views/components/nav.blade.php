<nav x-data="{
    open: false,
    language: false,
    accounts: false,
    megaMenu: null
}" class="sticky top-0 z-50 bg-gray-200 shadow-md">

    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between px-1 py-3 gap-3">

            <!-- Left -->
            <div class="flex items-center gap-3">

                <h1 class="text-base sm:text-base "><i class="bi bi-telephone-fill text-green-600"></i>
                    <span class="text">{{ __('messages.phone_number') }}</span>

                </h1>

            </div>

            
            <!-- Right -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Language -->
                <div class="relative">

                    <button @click="language = !language"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-2 rounded-lg flex items-center gap-2 text-sm cursor-pointer">

                        {{ strtoupper(app()->getLocale()) }}

                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-cloak x-show="language" x-transition @click.outside="language = false"
                        class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border z-[9999]">

                        <a href="{{ route('lang.switch', 'bn') }}" class="block px-4 py-2 hover:bg-gray-100">

                            বাংলা
                        </a>

                        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100">

                            English
                        </a>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="relative">

                    <button @click="accounts = !accounts"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-2 rounded-lg flex items-center gap-2 cursor-pointer">

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

        <!-- Top Navbar -->
        <div class="flex items-center justify-between py-3 gap-3">

            <!-- Left -->
            <div class="flex items-center gap-3">

                <!-- Logo -->
                <a href="/" class="font-bold leading-none">

                    <h1 class="text-base sm:text-base lg:text-3xl">
                        <span class="text-red-500">Electronics<span class="text-green-500">Zone</span></span>

                    </h1>
                </a>

                <div class="flex items-center pl-24 gap-10">

                    <!-- Category Mega Menu -->
                    <div class="relative" @mouseenter="megaMenu = 'category'" @mouseleave="megaMenu = null">

                        <button class="font-semibold text-xl hover:text-green-600 hover:underline decoration-green-600">
                            Category
                        </button>

                        <!-- Mega Menu -->
                        <div x-show="megaMenu === 'category'" x-transition
                            class="absolute left-0 top-full mt-3 w-[800px] bg-white shadow-xl rounded-lg border p-6 z-[9999]">

                            <div class="grid grid-cols-4 gap-6">

                                <div>
                                    <h3 class="font-bold text-lg mb-3 text-green-600">
                                        Computers
                                    </h3>

                                    <ul class="space-y-2">
                                        <li><a href="#" class="hover:text-green-600">Laptop</a></li>
                                        <li><a href="#" class="hover:text-green-600">Desktop</a></li>
                                        <li><a href="#" class="hover:text-green-600">Monitor</a></li>
                                    </ul>
                                </div>

                                <div>
                                    <h3 class="font-bold text-lg mb-3 text-green-600">
                                        Mobile
                                    </h3>

                                    <ul class="space-y-2">
                                        <li><a href="#" class="hover:text-green-600">Smartphone</a></li>
                                        <li><a href="#" class="hover:text-green-600">Tablet</a></li>
                                        <li><a href="#" class="hover:text-green-600">Smart Watch</a></li>
                                    </ul>
                                </div>

                                <div>
                                    <h3 class="font-bold text-lg mb-3 text-green-600">
                                        Accessories
                                    </h3>

                                    <ul class="space-y-2">
                                        <li><a href="#" class="hover:text-green-600">Keyboard</a></li>
                                        <li><a href="#" class="hover:text-green-600">Mouse</a></li>
                                        <li><a href="#" class="hover:text-green-600">Headphone</a></li>
                                    </ul>
                                </div>

                                <div>
                                    <img src="https://via.placeholder.com/250x200" class="rounded-lg w-full"
                                        alt="Banner">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Brand Mega Menu -->
                    <div class="relative" @mouseenter="megaMenu = 'brand'" @mouseleave="megaMenu = null"">

                        <button class="font-semibold text-xl hover:text-green-600 hover:underline decoration-green-600">
                            Brand
                        </button>

                        <div x-show="megaMenu === 'brand'" x-transition
                            class="absolute left-0 top-full mt-3 w-[600px] bg-white shadow-xl rounded-lg border p-6 z-[9999]">

                            <div class="grid grid-cols-3 gap-6">

                                <a href="#" class="hover:text-green-600">Apple</a>
                                <a href="#" class="hover:text-green-600">Samsung</a>
                                <a href="#" class="hover:text-green-600">Sony</a>
                                <a href="#" class="hover:text-green-600">Dell</a>
                                <a href="#" class="hover:text-green-600">HP</a>
                                <a href="#" class="hover:text-green-600">Asus</a>
                                <a href="#" class="hover:text-green-600">Xiaomi</a>
                                <a href="#" class="hover:text-green-600">Lenovo</a>
                                <a href="#" class="hover:text-green-600">LG</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-2xl">

                <input type="text" placeholder="{{ __('messages.search_placeholder') }}"
                    class="w-full border border-gray-300 border-r-0 px-4 py-2 outline-none rounded-l-lg">

                <button class="bg-green-500 hover:bg-green-700 text-white px-5 rounded-r-lg">

                    <i class="bi bi-search"></i>
                </button>
            </div>

            <!-- Right -->
            <div class="flex items-center gap-2 sm:gap-4">

                <!-- Wishlist -->
                <a href="#" class="relative text-gray-700 hover:text-green-600">

                    <i class="bi bi-heart text-xl sm:text-2xl"></i>

                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                        2
                    </span>
                </a>

                <!-- Cart -->
                <a href="#" class="relative text-gray-700 hover:text-green-600">

                    <i class="bi bi-cart text-xl sm:text-2xl"></i>

                    <span
                        class="absolute -top-2 -right-2 bg-green-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                        5
                    </span>
                </a>

            </div>
        </div>
    </div>

</nav>
