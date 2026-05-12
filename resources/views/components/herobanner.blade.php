<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="max-w-7xl mx-auto text-center">
    <div class="swiper myHeroSwiper overflow-hidden shadow-lg">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <a href="#">
                    <img src="{{ asset('images/banner1.png') }}"
                        class="hidden sm:block w-full">

                    <img src="{{ asset('images/mbanner1.png') }}"
                        class="block sm:hidden w-full">
                </a>
            </div>

            <div class="swiper-slide">
                <a href="#">
                    <img src="{{ asset('images/banner2.png') }}"
                        class="hidden sm:block w-full">

                    <img src="{{ asset('images/mbanner2.png') }}"
                        class="block sm:hidden w-full">
                </a>
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<style>
    /* Customizing the Pagination to match your Vue style */
    .swiper-pagination-bullet-active {
        background: #13f16c !important;
        width: 10px !important;
        border-radius: 5px !important;
        transition: all 0.3s;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.myHeroSwiper', {
            loop: true,
            spaceBetween: 20,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>