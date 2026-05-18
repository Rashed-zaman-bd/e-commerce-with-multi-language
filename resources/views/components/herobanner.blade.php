<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="max-w-7xl mx-auto text-center">
    <div class="swiper myHeroSwiper overflow-hidden shadow-lg">

        <div class="swiper-wrapper">

            @foreach ($heroes as $hero)
                <div class="swiper-slide">

                    <a href="{{ $hero->link ?? '#' }}">

                        {{-- Desktop Image --}}
                        <img
                            src="{{ asset('storage/' . $hero->image_dec) }}"
                            class="hidden sm:block w-full"
                            alt="Hero Banner">

                        {{-- Mobile Image --}}
                        <img
                            src="{{ asset('storage/' . $hero->image_mobile) }}"
                            class="block sm:hidden w-full"
                            alt="Hero Mobile Banner">

                    </a>

                </div>
            @endforeach

        </div>

        <div class="swiper-pagination"></div>

    </div>
</div>

<style>
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

        new Swiper('.myHeroSwiper', {
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