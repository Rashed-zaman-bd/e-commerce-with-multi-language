<div class="max-w-7xl mx-auto px-2 sm:px-0 py-8">

    <!-- Title -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg sm:text-xl md:text-3xl font-bold text-gray-800">
            {{ __('messages.special_offer') }}
        </h2>

        <a href="#"
           class="text-green-600 hover:text-green-700 font-semibold text-sm sm:text-base transition-all hover:translate-x-1 inline-flex items-center gap-1">
            View All <span class="text-lg">→</span>
        </a>
    </div>

    <!-- Product Scroll Area -->
    <div class="relative group">

        <!-- Left Button -->
        <button id="scrollLeftBtn"
            class="absolute -left-3 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg rounded-full w-8 h-8 sm:w-10 sm:h-10 hidden md:flex items-center justify-center hover:bg-gray-100 transition-all cursor-pointer">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 fill="green"
                 viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
            </svg>

        </button>

        <!-- Right Button -->
        <button id="scrollRightBtn"
            class="absolute -right-3 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg rounded-full w-8 h-8 sm:w-10 sm:h-10 hidden md:flex items-center justify-center hover:bg-gray-100 transition-all cursor-pointer">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 fill="green"
                 viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
            </svg>

        </button>

        <!-- Products -->
        <div id="productContainer"
             class="flex overflow-x-auto gap-3 sm:gap-4 scroll-smooth no-scrollbar pb-2">

            @foreach ($products as $product)

                <div class="flex-none w-[calc(50%-6px)] sm:w-[calc(33.333%-11px)] md:w-[calc(25%-12px)] lg:w-[calc(20%-13px)]">

                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 p-2 sm:p-4 relative flex flex-col h-full border border-gray-100 hover:border-green-100">

                        <!-- Product Image -->
                        <a href="#"
                           class="block relative w-full pt-[100%] overflow-hidden rounded-xl bg-gray-50 ">

                            @if($product->stock == 0)
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center z-20">
                                    <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded">
                                        Out of Stock
                                    </span>
                                </div>
                            @endif

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="absolute top-0 left-0 w-full h-full object-contain p-4 transition-transform duration-700 hover:scale-110">

                        </a>

                        <!-- Content -->
                        <div class="flex flex-col flex-1 mt-3">

                            <!-- Brand -->
                            <p class="text-gray-500 text-xs sm:text-sm">
                                {{ $product->brand->brand_name ?? 'No Brand' }}
                            </p>

                            <!-- Product Name -->
                            <h3 class="font-semibold text-sm sm:text-base md:text-lg mt-1 leading-tight line-clamp-2">
                                {{ $product->name }}
                            </h3>

                            <!-- Price -->
                            <div class="mt-2 flex items-center gap-2 flex-wrap">

                                <span class="text-red-600 font-bold text-lg sm:text-xl">
                                    ৳ {{ number_format($product->price) }}
                                </span>

                                @if($product->discount_percent)
                                    <span class="bg-green-100 text-black text-xs font-bold px-2 py-1 rounded-full">
                                        -{{ $product->discount_percent }}%
                                    </span>
                                @endif

                            </div>

                            <!-- Previous Price -->
                            @if($product->previous_price)
                                <span class="text-gray-400 line-through text-sm mt-1">
                                    ৳ {{ number_format($product->previous_price) }}
                                </span>
                            @endif

                            <!-- Features -->
                            <div class="flex flex-wrap gap-1 mt-2">

                                @if($product->emi)
                                    <span class="bg-blue-50 text-xs px-2 py-1 rounded-full">
                                        EMI
                                    </span>
                                @endif

                                @if($product->free_delivery)
                                    <span class="bg-purple-50 text-xs px-2 py-1 rounded-full">
                                        FD
                                    </span>
                                @endif

                                @if($product->exchange)
                                    <span class="bg-yellow-50 text-xs px-2 py-1 rounded-full">
                                        Exchange
                                    </span>
                                @endif

                            </div>

                            <!-- Button -->
                            <div class="mt-auto pt-3">

                                @if($product->stock > 0)

                                    <button
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-full transition-all">

                                        🛒 Add to Cart

                                    </button>

                                @else

                                    <button
                                        class="w-full bg-gray-300 text-gray-500 font-semibold py-2 rounded-full cursor-not-allowed">

                                        Out of Stock

                                    </button>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const container = document.getElementById('productContainer');

        document.getElementById('scrollLeftBtn')
            .addEventListener('click', () => {
                container.scrollBy({
                    left: -400,
                    behavior: 'smooth'
                });
            });

        document.getElementById('scrollRightBtn')
            .addEventListener('click', () => {
                container.scrollBy({
                    left: 400,
                    behavior: 'smooth'
                });
            });

    });
</script>