/**************************************************************************************************
 * PreLoader | 프리로더입니다.
 *
 * @class PreLoader
 * @constructor
 * @version 1.0
 *
 * @param {Array} assets 불러올 자원 배열
 * @param {Function} callback 콜백 함수
 *
 **************************************************************************************************/
window.PreLoader = function(assets, callback) {

	'use strict';

	if(this instanceof PreLoader === false) {
		return new PreLoader(assets, callback);
	}

	if(typeof assets !== 'object') return false;

	var _this = this;

	var LENGTH = assets.length;

	var	unit = 100 / LENGTH,
		progress = 0,
		loaded = false,
		imgs = [];

	this.initialize = function() {
		for(var i=0; i<assets.length; i++) {
			imgs[i] = new Image();
			this.setHandler(imgs[i]);
			imgs[i].src = assets[i];
		}
	};

	this.setHandler = function(img) {
		img.onload = this.calculate;
		img.onerror = this.report;
	};

	this.calculate = function() {
		progress += unit;
		if(Math.ceil(progress) >= 100) {
			if(loaded === false) _this.load();
			loaded = true;
		}
	};

	this.report = function() {
		if(typeof console === 'object') console.log(this.src + ' 이미지를 불러올 수 없습니다.');
		_this.calculate();
	}

	this.load = function() {
		if(typeof callback === 'function') callback();
	};

	this.initialize();
};


/**************************************************************************************************
 * FlowSlider | 흐르는 슬라이더입니다.
 *
 * @class FlowSlider
 * @constructor
 * @version 1.0
 *
 * @param {Object} container jQuery 객체
 * @param {Object} options 옵션 객체
 *
 **************************************************************************************************/
(function($) {

	'use strict';

	window.FlowSlider = function(container, options) {

		if(this instanceof FlowSlider === false) {
			return new FlowSlider(container, options);
		}

		var _this = this;

		var container = typeof container === 'object' ? container : $('#' + container),
			opt = {autoPlay: true, axis: 'x', pps: 60, reverse: false, stopOver: true};

		for(var prop in options) {
			opt[prop] = options[prop];
		}

		var wrapper = container.children(':first-child'),
			items = wrapper.children(),
			length = items.length;

		if(items.length === 0) return false;

		var	containerDim,
			wrapperDim = 0,
			itemDim = 0,
			scrollMax,
			animProp,
            init = true;

		var tl;

		var assetsLoaded = false,
			preLoadTimer = null,
			playTryCount = 0;

		var resizeTimer = null;

		this.initialize = function() {
			animProp = opt.axis === 'x' ? 'scrollLeft' : 'scrollTop';
			this.assetsPreload(function() {
				assetsLoaded = true;
				_this.setSliderProps();
				_this.setTimeline();
				_this.setHandler();
				_this.flow();
			});
		};

		this.assetsPreload = function(callback) {
			var assets = [];
			container.find('*').each(function(i) {
				if($(this).prop('tagName') === 'IMG') assets.push($(this).attr('src'));
			});
			if(assets.length > 0) new PreLoader(assets, callback);
			else callback();
		};

		this.setSliderProps = function() {
			containerDim = opt.axis === 'x' ? container.width() : container.height();
			itemDim = 0;
            for(var i=0, dim, gap; i<length; i++) {
				var bounding = items.eq(i)[0].getBoundingClientRect();
				if(opt.axis === 'x') {
					dim = items.eq(i).outerWidth(true);
					gap = bounding.width - items.eq(i).outerWidth();
					if(gap > 0) dim += gap;
				} else {
					dim = items.eq(i).outerHeight(true);
					gap = bounding.height - items.eq(i).outerHeight();
					if(gap > 0) dim += gap;
				}
				itemDim += dim;
			}
			wrapperDim = scrollMax = itemDim;
            if(init === true) {
                var appendCount = wrapperDim > containerDim ? 1 : Math.ceil(containerDim / wrapperDim);
				if(appendCount === Infinity) return false;
                for(var i=0; i<appendCount; i++) {
                    items.clone().addClass('flow-items-clone').appendTo(wrapper);
				}
				wrapperDim = itemDim * appendCount + itemDim;
            } else {
                if(wrapperDim < containerDim + scrollMax) {
                    var appendCount = Math.ceil(((containerDim + scrollMax) - wrapperDim) / scrollMax);
					if(appendCount === Infinity) return false;
					items.filter('.flow-items-clone').remove();
                    for(var i=0; i<appendCount; i++) {
                        items.not('.flow-items-clone').clone().addClass('flow-items-clone').appendTo(wrapper);
					}
					wrapperDim = itemDim * appendCount + itemDim;
                }
            }
			opt.axis === 'x' ? wrapper.width(wrapperDim) : wrapper.height(wrapperDim);
            items = wrapper.children();
            init = false;
		};

		this.setTimeline = function() {
			tl = new TimelineMax({paused: true, repeat: -1});
			var from = {}, to = {ease: Power0.easeNone};
			from[animProp] = opt.reverse === false ? 0 : scrollMax;
			to[animProp] = opt.reverse === false ? scrollMax : 0;
			tl.fromTo(container, scrollMax / opt.pps, from, to);
		};

		this.setHandler = function() {
			$(window).resize(this.handler.resize);
			if(opt.stopOver === true) {
				container.mouseenter(function() {
					if(opt.autoPlay === true) tl.pause();
				}).mouseleave(function() {
					if(opt.autoPlay === true) tl.play();
				});
			}
		};

		this.handler = {
			resize: function() {
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(function() {
					if(assetsLoaded === true) {
						_this.setSliderProps();
						_this.tlReset();
					}
				}, 100);
			}
		};

		this.tlReset = function() {
			tl.recent().vars.startAt[animProp] = opt.reverse === false ? 0 : scrollMax;
			tl.recent().vars[animProp] = opt.reverse === false ? scrollMax : 0;
			tl.duration(scrollMax / opt.pps);
			tl.invalidate();
		};

		this.flow = function() {
			if(opt.autoPlay === true) tl.play();
		};

		this.play = function() {
			clearTimeout(preLoadTimer);
			if(assetsLoaded === false) {
				if(playTryCount > 50) throw new Error('이미지 로딩이 끝나지 않아 play method를 호출할 수 없습니다.');
				preLoadTimer = setTimeout(function() {
					playTryCount++;
					_this.play();
				}, 100);
				return false;
			}
			if(assetsLoaded === true && tl.paused() === true) tl.play();
			opt.autoPlay = true;
		};

		this.stop = function() {
			if(assetsLoaded === true && tl.paused() === false) tl.pause();
			opt.autoPlay = false;
		};

		// FlowSlider class 초기화 함수를 호출합니다.
		this.initialize();
	};

}(jQuery));


(function($) {
    $(document).ready(function() {
        (function() {
            var $clipContainer = $('.lyr1_clip');
            var $clipParent = $('.clip_figure');
            var $clip = $('.clip_figure li').not(':eq(0)');
            var $clipList = $('.clip_list');
            var $clipListItems = $('.clip_list li');
            var translateRange = {
                min: 0,
                max: 0
            };
            var clipRange = [];
            var endBottom = 0;
            var length = $clip.length;

            var lastStep = 0;
            var clipTl = [];

            var windowHeight = 0;

            var scrollY = 0;

            var SIZE = 588;

            function setTimeline() {
                $clipListItems.each(function(i) {
                    clipTl[i] = new TimelineMax({paused: true});
                    var $this = $(this).find('.number');
                    if(i < length - 1) {
                        clipTl[i].to({number: 0}, 0.3, {number: $this.data('number'), onUpdateParams: [$this], onUpdate: function($self) {
                            var number = parseInt((this.vars['number'] * this.progress()), 10);
                            $self.text(number.toLocaleString());
                        }, onCompleteParams: [$this], onComplete: function($self) {
                            var number = parseInt((this.vars['number'] * 1), 10);
                            $self.text(number.toLocaleString());
                        }});
                    } else {
                        clipTl[i].to($this, 0.3, {opacity: 1, y: 0});
                    }
                });
            }

            function updateState() {
                windowHeight = window.innerHeight;
                translateRange.min = $clipList.offset().top - ((windowHeight - $clipParent.height()) / 2);
                translateRange.max = translateRange.min + $clipList.innerHeight() - ($clipList.innerHeight() / 3);
                endBottom = ($clipList.height() - (translateRange.max - translateRange.min)) / 2;
                var stepAmount = (translateRange.max - translateRange.min) / length;
                for(var i=0; i<length; i++) {
                    clipRange[i] = {};
                    clipRange[i].min = translateRange.min + (stepAmount * i);
                    clipRange[i].max = clipRange[i].min + stepAmount;
                }
            }

            function addEvent() {
                var resizeTimer = null;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                        updateState();
                    }, 100);
                });
                window.addEventListener('scroll', update);
            }

            function update() {
                // var progress = _.clamp((scrollY - translateRange.min) / (translateRange.max - translateRange.min), 0, 1);
                // var translateY = (translateRange.max - translateRange.min) * progress;
                // TweenLite.to($clipParent, 0.1, {y: translateY});

                scrollY = window.pageYOffset;
                if(scrollY >= translateRange.min && scrollY <= translateRange.max) {
                    TweenMax.set($clipParent, {position: 'fixed', top: '50%', bottom: 'auto', y: '-50%'});
                } else if(scrollY < translateRange.min) {
                    TweenMax.set($clipParent, {position: 'absolute', top: 0, bottom: 'auto', y: '0%'});
                } else if(scrollY > translateRange.max) {
                    TweenMax.set($clipParent, {position: 'absolute', top: 'auto', bottom: endBottom, y: '0%'});
                }
                updateClip();
                // updateTl();
            }

            function updateClip() {
                for(var i=0; i<length; i++) {
                    var progress = _.clamp((scrollY - clipRange[i].min) / (clipRange[i].max - clipRange[i].min), 0, 1);
                    var top = SIZE - (SIZE * progress);
                    var clip = 'rect: ('+ top +'px, '+ SIZE +'px, '+ SIZE +'px, 0px)';
                    TweenMax.to($clip.eq(i), 0.2, {clip: clip});
                    TweenMax.to($clip.eq(i).find('.divide_line'), 0.2, {top: top});
                }
            }

            function updateTl() {
                var progress = _.clamp((scrollY - translateRange.min) / (translateRange.max - translateRange.min), 0, 1);
                var step = _.clamp(Math.floor(progress * length), 0, length - 1);
                if(lastStep !== step) {
                    if(clipTl[lastStep]) clipTl[lastStep].pause(0);
                    clipTl[step].play();
                }
                lastStep = step;
            }

            function init() {
                setTimeline();
                updateState();
                addEvent();
            }

            init();
		}());

        new Swiper('.lyr2_slide .swiper-container', {
            direction: 'vertical',
            spaceBetween: 30,
            autoplay: {
                delay: 2000,
				disableOnInteraction: false,
            },
        });

        new FlowSlider($('.sales_slide > div'));

        new Swiper('.section3_slide .swiper-container', {
            slidesPerView: 'auto',
			centeredSlides: true,
			loop: true,
			spaceBetween: 36,
			autoplay: {
			   delay: 3000,
			},
        });

        new Swiper('.int_slide .swiper-container', {
			spaceBetween: 204,
            slidesPerView: 'auto',
            centeredSlides: true,
			loop: true,
			navigation: {
				prevEl: '.int_btn.int_prev_btn',
				nextEl: '.int_btn.int_next_btn'
			}
        });

        (function() {
            var $boxes = $(Utils.shuffle($('.lyr1_box').get()));
            var tl = new TimelineMax({delay: 0.5});
            $boxes.each(function(i) {
                tl.to(this, 0.3, {opacity: 0.2}, i > 0 ? '-=0.2' : '+=0');
            });
        }())

        var side_Motion;
        (function(){
            var $sideLayer = $('.side_layer');
            var $clipWrap = $('.clip_wrap');
            var r_top = 0;
            var r_bottom = $clipWrap.height();
            var r_left = 0;
            var r_right = $clipWrap.width();
            var tl_played = false;
            TweenMax.set($sideLayer, {height: r_bottom});
            TweenMax.set($clipWrap, {clip: 'rect(0,0,'+r_bottom+'px,0)'});
            side_Motion = new TimelineMax({paused: true}).to($clipWrap, 1, {clip: 'rect(0,'+r_right+'px,'+r_bottom+'px,0)', onStart: function(){
                tl_played = true;
            }});
            win.resize(function(){
                r_bottom = $clipWrap.height();
                r_right = $clipWrap.width();
                TweenMax.set($sideLayer, {height: r_bottom});
                if(tl_played){
                    TweenMax.set($clipWrap, {clip: 'rect(0,'+$clipWrap.width()+'px,'+$clipWrap.height()+'px,0)'});
                }else{
                    TweenMax.set($clipWrap, {clip: 'rect(0,0,'+$clipWrap.height()+'px,0)'});
                    side_Motion = new TimelineMax({paused: true}).to($clipWrap, 1, {clip: 'rect(0,'+r_right+'px,'+r_bottom+'px,0)', onStart: function(){
                        tl_played = true;
                    }});
                }
            })
        }());

        new YMotion([
            [
                {method: 'call', fx: function() {
                    side_Motion.play();
                }}
            ],
            [
                {el: $('.el2_2'), set: {x: -130}, to: {x: 0}, d: 0.3},
                {el: $('.el2_3'), set: {x: -260}, to: {x: 0}, d: 0.3},
                {el: $('.el2_3'), set: {x: -260}, to: {x: 0}, d: 0.3},
                {el: $('.el2_4'), set: {scale:  0}, to: {scale: 1, ease: Back.easeOut}, d: 0.3},
            ]
        ], {
            rewind: true
        }).activate();

        var cstTl = new TimelineMax();
        cstTl.add([
            new TweenMax('.wave_wrap .wave1', 1.4, {repeat: -1, scale: 1.4, opacity: 0}),
            new TweenMax('.wave_wrap .wave2', 1.4, {repeat: -1, scale: 1.4, opacity: 0, delay: 0.5})
		]);


    });
}(jQuery));



(function() {
    $(document).ready(function() {
        (function() {
            var $subNavList = $('.sub_nav_list');
            var $progress = $('.progress_fill');
            var isSpread = false;
            var swiper = new Swiper($('.sub_nav_view .swiper-container'), {
                direction: 'vertical',
                allowTouchMove: false
            });
            $('.header_wrap').on('click', '.sub_nav_view', function(e) {
                e.preventDefault();
                if(isSpread === false) {
                    $subNavList.stop().slideDown(200);
                    isSpread = true;
                } else {
                    $subNavList.stop().slideUp(200);
                    isSpread = false;
                }
            });
            $('.header_wrap').on('mouseleave', function(){
                if(isSpread === true){
                    $subNavList.stop().slideUp(200);
                    isSpread = false;
                }
            });
            var limitY = document.body.clientHeight - window.innerHeight;
            window.addEventListener('scroll', function() {
                var progress = window.pageYOffset / limitY * 100;
                TweenLite.to($progress, 0.2, {width: progress + '%'});
            });
            var resizeTimer = null;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    limitY = limitY = document.body.clientHeight - window.innerHeight;
                }, 100);
            });

            (function() {
                if(window.Scrollbar || $('.chapters').length === 0) return false;

                function setAnchorsOffset() {
                    var limit = doc.innerHeight() - win.innerHeight();
                    for(var i=0, j=0; i<length; i++) {
                        if($chapters.eq(i).length > 0) offsets[i] = $chapters.eq(i).offset().top - diff;
                        else offsets[i] = i > 0 ? offsets[i - 1] : 0;
                        if(offsets[i] > limit) {
                            offsets[i] = limit - length + j;
                            j++;
                        }
                    }
                    offsets[length] = limit + 1;
                }

                function scrollHandler() {
                    var scrollTop = win.scrollTop();
                    if(scrollTop < offsets[0]) {
                        index = -1;
                        return false;
                    }
                    for(var i=0; i<length; i++) {
                        if((i !== index) && (scrollTop >= offsets[i] && scrollTop < offsets[i + 1])) {
                            index = i;
                            swiper.slideTo(index);
                            
                            if(isSpread === true){
                                $subNavList.stop().slideUp(200);
                                isSpread = false;
                            }
                            break;
                        }
                    }
                }

                function scrollAnim(e) {
                    e.preventDefault();
                    TweenLite.to('html, body', 0.5, {scrollTop: offsets[$(this).index()], ease: Expo.easeOut});
                }

                function hashHandler() {
                    if(location.hash) {
                        var hashIndex = +location.hash.split('#')[1] - 1;
                        if($chapters.eq(hashIndex).length > 0) {
                            TweenLite.to('html, body', 0.5, {scrollTop: offsets[hashIndex], ease: Expo.easeOut});
                        }
                    }
                }

                var $chapters = $('.chapters'),
                    _anchors = '.sub_nav_list li';

                var length = $chapters.length,
                    offsets = [],
                    index = 0,
                    diff = 80,
                    resizeTimer = null;

                $('.header_wrap').on('click', _anchors, scrollAnim);
                win.scroll(scrollHandler);
                win.resize(function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                        setAnchorsOffset();
                        scrollHandler();
                    }, 100);
                });
                win.on('load', function() {
                    setAnchorsOffset();
                    scrollHandler();
                    hashHandler();
                });
                win.on('hashchange', hashHandler);

                setAnchorsOffset();
                scrollHandler();
            }());
        }());
    });
}(jQuery));