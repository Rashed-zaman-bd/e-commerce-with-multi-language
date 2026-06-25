<nav x-data="{
    open: false,
    language: false,
    accounts: false,
    megaMenu: null
}" class="sticky top-0 z-50 bg-gray-200 shadow-md w-full">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="hidden md:flex items-center justify-between py-2 border-b border-gray-300 gap-3">

            <div class="flex items-center gap-3">
                <h1 class="text-xs sm:text-sm flex items-center gap-1">
                    <i class="bi bi-telephone-fill text-green-600"></i>
                    <span>{{ __('messages.phone_number') }}</span>
                </h1>
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <div class="relative">
                    <button @click="language = !language"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-1.5 rounded-lg flex items-center gap-2 text-xs sm:text-sm cursor-pointer">
                        {{ strtoupper(app()->getLocale()) }}
                        <i class="bi bi-chevron-down text-[10px]"></i>
                    </button>

                    <div x-cloak x-show="language" x-transition @click.outside="language = false"
                        class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border z-[9999]">
                        <a href="{{ route('lang.switch', 'bn') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">বাংলা</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">English</a>
                    </div>
                </div>

                <div class="relative">
                    <button @click="accounts = !accounts"
                        class="bg-gray-100 hover:bg-gray-200 px-2 sm:px-3 py-1.5 rounded-lg flex items-center gap-2 cursor-pointer">
                        <i class="bi bi-person-circle text-lg sm:text-xl"></i>
                        <i class="bi bi-chevron-down text-[10px]"></i>
                    </button>

                    <div x-cloak x-show="accounts" x-transition @click.outside="accounts = false"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border z-[9999] overflow-hidden">
                        <a href="/login" class="block px-4 py-2 hover:bg-gray-100 text-sm">{{ __('messages.login') }}</a>
                        <a href="/register" class="block px-4 py-2 hover:bg-gray-100 text-sm">{{ __('messages.register') }}</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col md:flex-row items-center justify-between py-3 gap-3 md:gap-6">

            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="/" class="font-bold leading-none">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl">
                        <span class="text-red-500">Electronics<span class="text-green-500">Zone</span></span>
                    </h1>
                </a>

                <div class="flex items-center gap-3 sm:gap-4 md:hidden">
                    <div class="relative">
                        <button @click="language = !language"
                            class="bg-gray-100 hover:bg-gray-200 px-2 py-1.5 rounded-lg flex items-center gap-1 text-xs cursor-pointer">
                            {{ strtoupper(app()->getLocale()) }}
                            <i class="bi bi-chevron-down text-[10px]"></i>
                        </button>

                        <div x-cloak x-show="language" x-transition @click.outside="language = false"
                            class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border z-[9999]">
                            <a href="{{ route('lang.switch', 'bn') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">বাংলা</a>
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">English</a>
                        </div>
                    </div>

                    <a href="#" class="relative text-gray-700 hover:text-green-600">
                        <i class="bi bi-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">2</span>
                    </a>

                    <a href="#" class="relative text-gray-700 hover:text-green-600">
                        <i class="bi bi-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-green-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">5</span>
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6 lg:gap-10">
                <div class="relative" @mouseenter="megaMenu = 'category'" @mouseleave="megaMenu = null">
                    <button class="font-semibold text-lg hover:text-green-600 hover:underline decoration-green-600">
                        Category
                    </button>

                    <div x-show="megaMenu === 'category'" x-transition
                        class="absolute left-0 top-full mt-3 w-[750px] bg-white shadow-xl rounded-lg border p-6 z-[9999]">
                        <div class="grid grid-cols-4 gap-6">
                            <div>
                                <h3 class="font-bold text-base mb-3 text-green-600">Computers</h3>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="#" class="hover:text-green-600">Laptop</a></li>
                                    <li><a href="#" class="hover:text-green-600">Desktop</a></li>
                                    <li><a href="#" class="hover:text-green-600">Monitor</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-bold text-base mb-3 text-green-600">Mobile</h3>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="#" class="hover:text-green-600">Smartphone</a></li>
                                    <li><a href="#" class="hover:text-green-600">Tablet</a></li>
                                    <li><a href="#" class="hover:text-green-600">Smart Watch</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-bold text-base mb-3 text-green-600">Accessories</h3>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="#" class="hover:text-green-600">Keyboard</a></li>
                                    <li><a href="#" class="hover:text-green-600">Mouse</a></li>
                                    <li><a href="#" class="hover:text-green-600">Headphone</a></li>
                                </ul>
                            </div>
                            <div>
                                <img src="" class="rounded-lg w-full object-cover h-32" alt="Banner">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative" @mouseenter="megaMenu = 'brand'" @mouseleave="megaMenu = null">
                    <button class="font-semibold text-lg hover:text-green-600 hover:underline decoration-green-600">
                        Brand
                    </button>

                    <div x-show="megaMenu === 'brand'" x-transition
                        class="absolute left-0 top-full mt-3 w-[500px] bg-white shadow-xl rounded-lg border p-6 z-[9999]">
                        <div class="grid grid-cols-3 gap-4 text-sm">
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

            <div class="hidden md:flex items-center w-full md:w-auto max-w-md">
                <input type="text" placeholder="{{ __('messages.search_placeholder') }}"
                    class="border border-gray-300 border-r-0 px-3 py-1.5 outline-none rounded-l-lg w-full md:w-64 text-sm">
                <button class="bg-green-500 hover:bg-green-700 text-white px-4 py-1.5 rounded-r-lg flex items-center justify-center">
                    <i class="bi bi-search text-sm"></i>
                </button>
            </div>

            <div class="hidden md:flex items-center gap-4">
                <a href="#" class="relative text-gray-700 hover:text-green-600">
                    <i class="bi bi-heart text-2xl"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">2</span>
                </a>

                <a href="#" class="relative text-gray-700 hover:text-green-600">
                    <i class="bi bi-cart text-2xl"></i>
                    <span class="absolute -top-2 -right-2 bg-green-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">5</span>
                </a>
            </div>

        </div>
    </div>
</nav>