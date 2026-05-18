@props(['items'])

<div
    x-data="{
        scrollLeft() {
            this.$refs.slider.scrollBy({ left: -300, behavior: 'smooth' })
        },
        scrollRight() {
            this.$refs.slider.scrollBy({ left: 300, behavior: 'smooth' })
        }
    }"
    class="container mx-auto py-8"
>
    <!-- Section Title -->
    <div class="flex justify-center mb-4 sm:mb-8">
        <p class="text-xl md:text-3xl font-semibold text-gray-800">
            {{ __('messages.what_is') }}
        </p>
    </div>

    <div class="relative">

        <!-- Left Button -->
        <button
            @click="scrollLeft"
            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100"
        >
            <i class="bi bi-chevron-left text-green-600 text-xl"></i>
        </button>

        <!-- Cards -->
        <div
            x-ref="slider"
            class="flex gap-4 overflow-x-auto scroll-smooth scrollbar-hide px-12"
        >
            @forelse ($items as $item)
                <div class="flex-none w-40 sm:w-48 p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <a href="#">

                        <!-- Image -->
                        <div class="relative h-32 sm:h-48 overflow-hidden">
                            @if ($item->image)
                                <img
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition duration-300"
                                >
                            @else
                                <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-image text-gray-400 text-3xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Title -->
                        <div class="text-center mt-3">
                            <p class="text-lg font-medium text-gray-800 group-hover:text-green-600">
                                {{ $item->title }}
                            </p>
                        </div>

                    </a>
                </div>
            @empty
                <p class="text-gray-500 text-center w-full py-8">No menu items found.</p>
            @endforelse
        </div>

        <!-- Right Button -->
        <button
            @click="scrollRight"
            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100"
        >
            <i class="bi bi-chevron-right text-green-600 text-xl"></i>
        </button>

    </div>

</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>