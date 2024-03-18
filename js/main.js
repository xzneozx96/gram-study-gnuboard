(function($){
    $(document).ready(function() {
        var toggleItems = [];

        (function() {
            var swiper1 = new Swiper('.lyr3_left_slide .swiper-container', {
                allowTouchMove: false,
				/*loop:true,
				loopFillGroupWithBlank : true*/
				
            });
            var swiper2 = new Swiper('.lyr3_right_slide .swiper-container', {
                autoplay: {delay: 5000},
                navigation: {
                    prevEl: '.lyr3_right_slide .swiper-button-prev',
                    nextEl: '.lyr3_right_slide .swiper-button-next'
                },
                pagination: {
                    el: '.lyr3_right_slide .swiper-pagination',
                    type: 'progressbar'
                },
				/*loop:true,
				loopFillGroupWithBlank : true*/
            });
            swiper2.on('slideChange', function() {
                swiper1.slideTo(swiper2.activeIndex);
            });

            toggleItems.push({
                $container: $('.lyr3_wrap'),
                instance: swiper2,
                plugin: 'swiper'
            });
        }());

        (function() {
            var swiper3 = new Swiper('.lyr4_left_slide .swiper-container', {
                allowTouchMove: true,
				/*loop:true,
				loopFillGroupWithBlank : true*/
            });
            var swiper4 = new Swiper('.lyr4_right_slide .swiper-container', {
				autoplay: {delay: 5000},
				spaceBetween: 30,
                pagination: {
                    el: '.box_inner .gr-pagination',
                    type: 'bullets',
                    clickable: true,
                },
				/*loop:true,
				loopFillGroupWithBlank : true*/
            });
            swiper4.on('slideChange', function() {
                swiper3.slideTo(swiper4.activeIndex);
            });

            toggleItems.push({
                $container: $('.lyr4_wrap'),
                instance: swiper4,
                plugin: 'swiper'
            });
        }());

    });
}(jQuery));
