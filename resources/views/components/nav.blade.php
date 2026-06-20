<nav x-data="{
    open: false,
    language: false,
    accounts: false
}" class="sticky top-0 z-50 bg-white shadow-md">

    <div class="max-w-7xl mx-auto">

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

