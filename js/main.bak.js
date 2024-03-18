
(function($) {
    'use strict';

	window.Counting = function(elems, options) {

		var _this = this;

        var opt = {type: 'text', unit: 'px', duration: 100, delay: 1000, interval: 5000, repeat: 0, loop: 1, diff: 100, min: 0, max: 10, slowFx: false, slowV: 10, anim: false, reverse: false};

		var	numbers = [], repeatTimer = null, slotTimer = [], repeat = 0, turning, slowlyI = 0, animTl = [];

		var length, limit;

		this.initialize = function() {
            for(var prop in options) {
    			opt[prop] = options[prop];
    		}
			if(opt.reverse === true) elems = $(elems.get().reverse());
            turning = opt.max - opt.min;
            length = elems.length,
            limit = turning * opt.loop * length - 1;
			var numbers = [];
			for(var i=0; i<length; i++) {
				numbers[i] = elems.eq(i).data('number');
			}
			this.setNumbers(numbers, opt.loop);
            if(opt.anim === true && opt.type === 'img') {
                this.setTimeline(opt.loop);
            }
		};

		this.setNumbers = function(num, loop) {
			for(var i=0, start; i<length; i++) {
                numbers[i] = [];
				start = num[i] + 1;
				for(var j=0; j<turning * loop; j++) {
					if(opt.anim === false && start === turning) start = opt.min;
					numbers[i][j] = start;
					start++;
				}
			}
		};

        this.setTimeline = function(loop) {
            for(var i=0; i<length; i++) {
                animTl[i] = new TimelineLite({paused: true, delay: i * (opt.delay / 1000), onCompleteParams: [i], onComplete: function(k) {
					if(k === length - 1) {
						if(opt.repeat === 1 || repeat < opt.repeat - 1) {
							_this.setTimer();
							repeat++;
						} else {
							typeof opt.callback === 'function' ? opt.callback() : null;
						}
					}
                }});
                for(var j=0, val; j<turning * loop; j++) {
                    if(opt.slowFx === true) j - (turning * (loop - 1)) >= 0 ? slowlyI++ : slowlyI = 0;
                    if(opt.unit === 'px') {
                        animTl[i].to(elems.eq(i), (opt.duration / 1000) + (Math.pow(slowlyI, 2) * (opt.slowV / 1000)), {backgroundPositionY: numbers[i][j] * -opt.diff});
                    } else {
                        animTl[i].to(elems.eq(i), (opt.duration / 1000) + (Math.pow(slowlyI, 2) * (opt.slowV / 1000)), {top: numbers[i][j] * -100 + '%'});
                    }
                }
            }
        };

		this.setTimer = function() {
			clearTimeout(repeatTimer);
			repeatTimer = setTimeout(function() {
				_this.play();
			}, 5000);
		};

		this.play = function() {
            if(opt.type === 'img' && opt.anim === true) {
                for(var i=0; i<length; i++) {
                    animTl[i].restart(true, false);
                }
            } else {
                for(var i=0; i<length; i++) {
                    for(var j=0; j<turning * opt.loop; j++) {
                        this.queue(i, j);
                    }
                }
            }
        };

        this.queue = function(i, j) {
            if(opt.slowFx === true) j - (turning * (opt.loop - 1)) >= 0 ? slowlyI++ : slowlyI = 0;
            var t = (j * opt.duration) + (i * opt.delay) + (Math.pow(slowlyI, 2) * opt.slowV);
            var k = turning * opt.loop * i + j;
            slotTimer[k] = setTimeout(function() {
                if(opt.type === 'text') elems.eq(i).text(numbers[i][j]);
                else {
                    if(opt.unit === 'px') {
                        elems.eq(i).css({backgroundPositionY: numbers[i][j] * -opt.diff});
                    } else {
                        elems.eq(i).css({top: numbers[i][j] * -100 + '%'});
                    }
                }
                if(k === limit) {
                    if(opt.repeat === 1 || repeat < opt.repeat - 1) {
                        _this.setTimer();
                        repeat++;
                    } else {
                        typeof opt.callback === 'function' ? opt.callback() : null;
                    }
                }
            }, t);
		};

		this.reset = function(e, o) {
			clearTimeout(repeatTimer);
			for(var i=0; i<length; i++) {
				animTl[i].pause(0);
				animTl[i].kill();
			}
            if(typeof o === 'object') options = o;
            if(typeof e === 'object') elems = e;
			length = 0;
			limit = 0;
			this.initialize();
		};

		this.initialize();
	};

}(jQuery));


(function($){
    $(document).ready(function() {
        var toggleItems = [];

        new DimensionFix($('.lyr_05_movie'), {
            fixElem: $('.lyr_05_movie').find('iframe'),
            w: 1970,
            h: 1000
        }).fix();

        (function() {
            var $countingItems = $('.lyr2_slide .swiper-slide');
            var group = 4;
            var step = Math.ceil($countingItems.length / group);
            var counter = [];
            for(var i=0; i<step; i++) {
                $elem = $countingItems.slice(group * i, group * (i + 1));
                counter[i] = new Counting($elem.find('.num'), {
                    duration: 20,
                    delay: 100,
                    interval: 1000,
                    repeat: 1
                });
            }
            var swiper = new Swiper('.lyr2_slide .swiper-container',{
                autoplay: {
                    delay: 5000
                },
                slidesPerView: 2,
                slidesPerColumn: 2,
                slidesPerGroup: 2,
                pagination: {
                    el: $('.lyr2_paging'),
                    type: 'bullets',
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<li class="' + className + '"><a href="#none"></a></li>';
                    }
                },
                on: {
                    slideChangeTransitionEnd: function() {
                        counter[swiper.snapIndex].play();
                    },
                    autoplayStart: function() {
                        counter[0].play();
                    }
                }
            });

            toggleItems.push({
                $container: $('.lyr2_slide .swiper-container'),
                instance: swiper,
                plugin: 'swiper'
            });
        }());

        // new Swiper('.lyr_03_list .swiper-container',{
        //     slidesPerView: 'auto',
        //     loop: true,
        //     navigation: {
        //         prevEl: '.lyr_03_list .list_prev',
        //         nextEl: '.lyr_03_list .list_next',
        //     },
        //     pagination: {
        //         el: '.lyr_03_progress .swiper-pagination',
        //         type: 'progressbar',
        //     },
        // });
        // new Swiper('.lyr_04_list1 .swiper-container',{
        //     direction: 'vertical',
        //     slidesPerView: 'auto',
        //     spaceBetween: 60,
        //     // loop: true,
        //     // navigation: {
        //     //     prevEl: '.lyr_03_list .list_prev',
        //     //     nextEl: '.lyr_03_list .list_next',
        //     // },
        //     pagination: {
        //         el: '.lyr_04_progress .swiper-pagination',
        //         type: 'progressbar',
        //     },
        // });
        // new Swiper('.lyr_04_list2 .swiper-container',{
        //     slidesPerView: 'auto',
        //     spaceBetween: 130,
        //     loop: true,
        //     // loop: true,
        //     // navigation: {
        //     //     prevEl: '.lyr_03_list .list_prev',
        //     //     nextEl: '.lyr_03_list .list_next',
        //     // },
        // });

        (function() {
            var swiper1 = new Swiper('.lyr3_left_slide .swiper-container', {
                allowTouchMove: false
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
                }
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
            var $swiperPaging = $('.lyr4_left_slide li');
            var swiper = new Swiper('.lyr4_right_slide .swiper-container', {
                autoplay: {delay: 5000},
                on: {
                    slideChangeTransitionStart: function() {
                        $swiperPaging.filter('.on').removeClass('on');
                        $swiperPaging.eq(swiper.activeIndex).addClass('on');
                    }
                },
                spaceBetween: 30,
				pagination: {
                    el: '.box_inner .gr-pagination',
                    type: 'bullets',
                    clickable: true,
					
                }
                /*pagination: {
                    el: '.box_inner .swiper-pagination',
                    type: 'progressbar',
                    progressbarOpposite: true
                }*/
            });
			
			swiper2.on('slideChange', function() {
                swiper1.slideTo(swiper2.activeIndex);
            });
			
            toggleItems.push({
                $container: $('.lyr_04'),
                instance: swiper,
                plugin: 'swiper'
            });
        }());

        new MotionToggle(toggleItems);

        var counter = new Counting($('.lyr5_list .num'), {
            duration: 20,
            delay: 100,
            interval: 1000,
            repeat: 1
        });

        new YMotion([
            [
                {method: 'call', fx: function() {
                    counter.play();
                }}
    		]
        ]).activate();

        (function() {
            var $scElement = $('html, body');
            var $wrapper = $('#wrap');
            var scrollTop;
            $('body').on('click','.bindModalOpen',function(e){
                $.ajax({
                    url : $(this).attr('href'),
                    data:{
                        idx : $(this).data('idx'),
                        type : 'view',
                    },
                    success : function(result){
                        scrollTop = $(window).scrollTop();
                        $scElement.css({overflow: 'hidden', position: 'fixed', width: '100%', height: '100%'});
                        TweenLite.set($wrapper, {y: scrollTop * -1});
                        $('.pv-container-parent', result).appendTo($('body'));
                    }
                });
                e.preventDefault();
            });

            $('body').on('click','.pv-closer',function(){
                $scElement.css({overflow: 'auto', position: 'static', width: 'auto', height: 'auto'}).scrollTop(scrollTop);
                TweenLite.set($wrapper, {clearProps: 'zIndex, transform'});
                $(this).closest('.pv-container-parent').fadeOut(450,function(){
                    $(this).remove();
                });
            });
        }());
    });
}(jQuery));
