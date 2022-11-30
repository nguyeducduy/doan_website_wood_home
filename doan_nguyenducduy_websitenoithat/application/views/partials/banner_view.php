<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<style>
html,
body {
    position: relative;
    height: 100%;
}

body {
    background: #eee;
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #000;
    margin: 0;
    padding: 0;
}

.swiper {
    width: 100%;
    padding-top: 50px;
    padding-bottom: 50px;
}

.swiper-slide {
    background-position: center;
    background-size: cover;
    width: 300px;
    height: 300px;
}

.swiper-slide img {
    display: block;
    width: 100%;
    height: 300px;
    border-radius: 20px;

}
</style>
<section class="span9 first">
    <div class="blog-sec-slider">

        <body>
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_1.jpg"
                                alt="" /></a></div>
                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_2.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_3.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_4.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_5.jpg"
                                alt="" /></a></div>
                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_6.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_7.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_8.1.jpg"
                                alt="" /></a></div>

                    <div class="swiper-slide "><a><img src="<?php echo base_url(); ?>public/images/slider_9.jpg"
                                alt="" /></a></div>

                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper JS -->
            <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

            <!-- Initialize Swiper -->
            <script>
            var swiper = new Swiper(".mySwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                },
            });
            </script>
        </body>
    </div>