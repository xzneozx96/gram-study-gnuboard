window.MainScrollMotion = function() {
    var $scrollElement;
    var _instance;

    //brand_visual
    var $brandVisual = $('.brand_visual');
    var $bvVideo = $('.brand_visual .bv_video_wrap');
    var $bvTitle = $('.brand_visual .bv_head');
    var $bvScrollBar = $('.brand_visual .scroll_wrap');
    var bvPlayer = new Vimeo.Player($('.bv_video > iframe')[0]);
    var bvVideoOn = false;
    var bv_top;
    var bv_bot;
    var bv_mid;
    var bvVideo_top;
    var bvVideo_bot;
    var bvTitle_bot;
    var bvTitle_mid;
    //first&only
    var $foWrap = $('.fo_wrap');
    var $foTitleWrap = $('.fo_title_wrap');
    var $first = $('.first');
    var $only = $('.only');
    var first_top;
    var first_bot;
    var foToggle1 = false;
    var foToggle2 = false;
    var foChange1;
    var foChange2;
    //fob
    var $fob = $('.fob');
    var $fobTitle1 = $('.fob_title1');
    var $fobTitle2 = $('.fob_title2');
    var $fobTitle3 = $('.fob_title3');
    var fobTween = false;
    var fobTl = new TimelineMax({paused: true}).fromTo($fobTitle1, 0.4, {y: 100, opacity: 0}, {y: 0, opacity: 1}).fromTo($fobTitle2, 0.4, {y: 100, opacity: 0}, {y: 0, opacity: 1, delay: -0.2}).fromTo($fobTitle3, 0.4, {y: 100, opacity: 0}, {y: 0, opacity: 1, delay: -0.2});
    var fobOffset;

    //parallax
    var $parallaxWrap = $('.parallax_wrap');
    var parallax_length = $parallaxWrap.length;
    var parallax_top = [];
    var parallax_bot = [];
    var parallax_mid = [];
    var parallax_height = [];
    //ingre
    var domImg = [$('.ingre .box1'), $('.ingre .box2'), $('.ingre .box3'), $('.ingre .box4'), $('.ingre .box5')];
    var domImg_top = [];
    var domImgGra_top = [];
    var domImg_bottom = [];
    var domImg_mid = [];
    var domImgGra_top_mid = [];
    //side_layer
    var $sideLayer = $('.side_layer');
    var $clipWrap = $('.clip_wrap');
    var slTween = false;
    var slToggle = false;
    var sideLayerChange;
    var slWidth;
    var slHeight;

    var $header = $('.header_wrap');
    var headerY = 48;
    var isHeaderFixed = false;

    var $botFixedElems = $('.kakao_link, .btn_pop_inq');
    var $botDiffElem = $('.footer_wrap');
    var botRange = {
        min: 0,
        max: 0
    };

    var $btnTop = $('.top_btn');

    var windowHeight = 0;
    var offsetY = 0;
    var direction;

    var $chapters = $('.chapters');
    var _cAnchors = '.sub_nav_list li';
    var cLength = $chapters.length;
    var cOffsets = [];
    var cIndex = 0;
    var cDiff = 80;
    var cSwiper = new Swiper($('.sub_nav_view .swiper-container'), {
        direction: 'vertical',
        allowTouchMove: false
    });

    var $progressBar = $('.progress_fill');
    var progress_top;
    var progress_bot;
    var progress_mid;

    function setState() {
        windowHeight = window.innerHeight;
        offsetY = _instance.offset.y;
        setAnchorsOffset();
        setMotion();
        setBotRange();
    }

    function setAnchorsOffset() {
        $chapters.each(function(i) {
            cOffsets[i] = offsetY + $(this).offset().top - cDiff;
            if(cOffsets[i] > _instance.limit.y) {
                cOffsets[i] = _instance.limit.y - cLength + j;
                j++;
            }
        });
        cOffsets[cLength] = _instance.limit.y + 1;

        for(var i=0, j=0; i<cLength; i++) {
            cOffsets[i] = offsetY + $chapters.eq(i).offset().top - cDiff;
            if(cOffsets[i] > _instance.limit.y) {
                cOffsets[i] = _instance.limit.y - cLength + j;
                j++;
            }
        }
        cOffsets[cLength] = _instance.limit.y + 1;
    }

    function setMotion() {
        //brand_visual
        bv_top = $brandVisual.offset().top + offsetY;
        bv_bot = $brandVisual.height();
        bv_mid = bv_bot - bv_top;
        bvVideo_top = bv_top + 200;
        bvVideo_bot = bv_bot - windowHeight/4;
        bvTitle_bot = windowHeight/2;
        bvTitle_mid = bvTitle_bot - bv_top;
        //first&only
        first_top = $foWrap.offset().top + offsetY;
        first_bot = first_top + windowHeight;
        foChange1 = first_top - 100;
        foChange2 = first_top + windowHeight - 400;
        //fob
        fobOffset = $fob.offset().top - 400 + offsetY;
        //parallax
        $parallaxWrap.each(function(i){
            parallax_top[i] = $(this).offset().top - windowHeight + offsetY;
            parallax_bot[i] = $(this).offset().top + $(this).height() + offsetY;
            parallax_mid[i] = parallax_bot[i] - parallax_top[i];
            parallax_height[i] = $(this).height();
        });
        //ingre
        for (var i = 0; i < domImg.length; i++) {
            if(domImg[i]){
                domImg_top[i] = domImg[i].offset().top - windowHeight + offsetY;
                domImg_bottom[i] = domImg_top[i] + windowHeight/4*3;
                domImg_mid[i] = domImg_bottom[i] - domImg_top[i];
                // domImgGra_top[i] = domImg[i].offset().top + domImg[i].data('height')/2 - windowHeight;
                // domImgGra_top_mid[i] = domImg_bottom[i] - domImgGra_top[i];
                TweenMax.set(domImg[i], {transformOrigin: 'center top'})
            }
        }
        //side_layer
        sideLayerChange = $sideLayer.offset().top - windowHeight/4*3 + offsetY;
        slWidth = $sideLayer.width();
        slHeight = $sideLayer.height();
        $clipWrap.width(slWidth)
        if(slTween === true){
            TweenMax.set($clipWrap, {clip: 'rect(0,'+slWidth+'px,'+slHeight+'px,0)'});
        }
        if(slToggle === false){
            TweenMax.set($clipWrap, {clip: 'rect(0,0,'+slHeight+'px,0)'});
        }


        progress_top = 0;
        progress_bot = $('.scroll-content').height() - windowHeight;
    }

    function setBotRange() {
        botRange.min = 0;
        botRange.max = _instance.limit.y - $botDiffElem.outerHeight(true);
    }

    function addEvent() {
        $('.header_wrap').on('click', _cAnchors, scrollAnim);
        win.on('hashchange', hashHandler);
        $btnTop.on('click', function() {
            _instance.scrollTo(0, 0, 300);
        });
    }

    function scrollAnim(e) {
        _instance.scrollTo(0, cOffsets[$(this).index()], 0);
    }

    function hashHandler() {
        if(location.hash) {
            var hashIndex = +location.hash.split('#')[1] - 1;
            if($chapters.eq(hashIndex).length > 0) {
                _instance.scrollTo(0, cOffsets[hashIndex], 0);
            }
        }
    }

    function update() {
        offsetY = _instance.offset.y;
        updateNavigation();
        updateMotion();
        updateHeader();
        updateBot();
    }

    function updateNavigation() {
        if(offsetY < cOffsets[0]) {
            cIndex = -1;
            return false;
        }
        for(var i=0; i<cLength; i++) {
            if((i !== cIndex) && (offsetY >= cOffsets[i] && offsetY < cOffsets[i + 1])) {
                cIndex = i;
                cSwiper.slideTo(cIndex);

                $('.sub_nav_list').stop().slideUp(200);

                break;
            }
        }
    }

    function updateMotion() {
        //brand_visual
        var bvVideo_y = _.clamp(offsetY, bv_top, bv_bot) - bv_top;
        var bvTitle_opacity = _.clamp((offsetY-bv_top)/bvTitle_mid, 0, 1);
        TweenMax.set($bvVideo, {y: bvVideo_y});
        TweenMax.set($bvTitle, {y: bvVideo_y - 106 - (100*bvTitle_opacity), opacity: 1-bvTitle_opacity})
        TweenMax.set($bvScrollBar, {y: bvVideo_y, opacity: 1-bvTitle_opacity})
        if(offsetY < bvVideo_top || offsetY >= bvVideo_bot && bvVideoOn === true){
            bvPlayer.pause();
            bvVideoOn = false;
        }else if(offsetY >= bvVideo_top && offsetY < bvVideo_bot && bvVideoOn === false){
            bvPlayer.play();
            bvVideoOn = true;
        }
        //first&only
        var first_y = _.clamp(offsetY, first_top, first_bot) - first_top;
        TweenMax.set($first, {y: first_y})
        TweenMax.set($foTitleWrap, {y: first_y})
        if(offsetY >= foChange1 && foToggle1 === false){
            TweenMax.to('.first_food', 0.5, {opacity: 1});
            TweenMax.to('.first_bowl', 0.5, {opacity: 0, delay: 0.5});
            foToggle1 = true;
        }else if(offsetY < foChange1 && foToggle1 === true){
            TweenMax.to('.first_food', 0.5, {opacity: 0});
            TweenMax.to('.first_bowl', 0.5, {opacity: 1});
            foToggle1 = false;
        }
        if(offsetY >= foChange2 && foToggle2 === false){
            TweenMax.to('.first_title, .first_text', 0.3, {opacity: 0});
            TweenMax.to('.only_head, .only_text', 0.3, {opacity: 1, delay: 0.2});
            TweenMax.fromTo('.only_stick', 1, {y: 100, opacity: 0}, {y: 0, opacity: 1});
            foToggle2 = true;
        }else if(offsetY < foChange2 && foToggle2 === true){
            TweenMax.to('.first_title, .first_text', 0.3, {opacity: 1});
            TweenMax.to('.only_head, .only_text', 0.3, {opacity: 0});
            TweenMax.to('.only_stick', 0.5, {y: 100, opacity: 0});
            foToggle2 = false;
        }
        //fob
        if(offsetY >= fobOffset && fobTween === false){
            fobTl.play();
            fobTween = true;
        }else if(offsetY < fobOffset && fobTween === true){
            fobTl.reverse();
            fobTween = false;
        }
        //parallax
        $parallaxWrap.each(function(i){
            var progress = _.clamp((offsetY-parallax_top[i])/parallax_mid[i], 0, 1);
            var y = parallax_height[i]*0.3;
            TweenMax.set($(this).find('.parallax_bg'), {y: -y + (y*2*progress)});
        });
        //ingre
        for (var i = 0; i < domImg.length; i++) {
            var progress = _.clamp((offsetY-domImg_top[i])/domImg_mid[i], 0, 1);
            // var progress = (scrollTop - domImg_top[i])/domImg_mid[i];
            // progress = progress < 0 ? 0 : progress;
            // progress = progress > 1 ? 1 : progress;
            TweenMax.set(domImg[i], {scale: 0.7 + (0.3*progress),opacity: 0.3 + (0.7*progress), ease: Power0.easeNone});
            // var gra_progress = (scrollTop - domImgGra_top[i])/domImgGra_top_mid[i];
            // gra_progress = gra_progress < 0 ? 0 : gra_progress;
            // gra_progress = gra_progress > 1 ? 1 : gra_progress;
            // TweenMax.set(domImg[i].find('.img_gra'), {y: -100*gra_progress+'%', ease: Power0.easeNone})
        }
        //side_layer
        if(offsetY >= sideLayerChange && slToggle === false){
            TweenMax.fromTo($clipWrap, 1, {clip: 'rect(0,0,'+slHeight+'px,0)'}, {clip: 'rect(0,'+slWidth+'px,'+slHeight+'px,0)', onComplete: function(){
                slTween = true;
            }});
            slToggle = true;
        }

        var progressBarPro = _.clamp(offsetY/progress_bot, 0, 1)*100;
        TweenMax.set($progressBar, {width: progressBarPro+"%"});
    }

    function updateHeader() {
        TweenMax.set($header, {y: offsetY});
        if(offsetY > headerY && isHeaderFixed === false) {
            $header.addClass('is_fixed');
            isHeaderFixed = true;
        } else if(offsetY < headerY && isHeaderFixed === true) {
            $header.removeClass('is_fixed');
            isHeaderFixed = false;
        }
    }

    function updateBot() {
        var translateY = _.clamp(offsetY, botRange.min, botRange.max) - botRange.min;
        $botFixedElems.css('transform', 'translateY('+ translateY +'px)');
    }

    function goToTarget() {
        var targetRegExp = /target\=([A-Za-z0-9._-]+)/g;
        var target = targetRegExp.exec(location.search);
        if(!target) return false;
        if(target[1] && $(target[1]).length === 1) {
            var targetOffset = offsetY + $(target[1]).offset().top - cDiff;
            _instance.scrollTo(0, targetOffset, 0);
        }
    }

    this.init = function() {
        function ScrollBarPlugin() {};
        ScrollBarPlugin.pluginName = 'mainPlugin';
        ScrollBarPlugin.prototype.transformDelta = function() {};
        ScrollBarPlugin.prototype.onInit = function() {
            $scrollElement = $('.scroll-content');
            setState();
            addEvent();
            goToTarget();
        };
        ScrollBarPlugin.prototype.onRender = function(delta) {
            if(delta.y > 0) {
                direction = 'forward';
            } else if(delta.y < 0) {
                direction = 'reverse';
            }
            update();
        };
        ScrollBarPlugin.prototype.onUpdate = function() {
            setState();
        };
        window.Scrollbar.use(ScrollBarPlugin);
        _instance = window.Scrollbar.init(document.querySelector('#wrap'), {
            alwaysShowTracks: false
        });
    };
};


(function($) {
    $(document).ready(function() {
        var scrollMotion = new MainScrollMotion();
        scrollMotion.init();

        var scrollTl = new TimelineMax({repeat: -1})
        scrollTl.fromTo('.brand_visual .scroll_bar', 0.5, {y: '-100%'}, {y: '0%', delay: 0.3});
        scrollTl.to('.brand_visual .scroll_bar', 0.5, {y: '100%', delay: 0.5});

        new DimensionFix($('.bv_video_wrap'), {
            fixElem: $('.bv_video iframe'),
            w: 1920,
            h: 1080
        }).fix();

        new DimensionFix($('.fob_back .parallax_inner'), {
            fixElem: $('.fob_back .parallax_inner iframe'),
            w: 1920,
            h: 1080
        }).fix();

        // (function(){
        //     var scrollTop;
        //     var winHeight = win.height();
        //     //brand_visual
        //     var $brandVisual = $('.brand_visual')
        //     var bv_play_top;
        //     var bv_stop_top;
        //     var bv_vimeo = new Vimeo.Player($('.bv_video iframe'));
        //     var video_played = false;
        //     //parallax
        //     var $parallaxWrap = $('.parallax_wrap');
        //     var parallax_length = $parallaxWrap.length;
        //     var parallax_top = [];
        //     var parallax_bot = [];
        //     var parallax_mid = [];
        //     var parallax_height = [];
        //     //first
        //     var $firstBowl = $('.first_bowl');
        //     var $firstFood = $('.first_food');
        //     var firstFoodTl = new TimelineMax({paused: true}).fromTo($firstFood, 0.5, {opacity: 0}, {opacity: 1, ease: Expo.easeIn});
        //     var firstBowlTl = new TimelineMax({paused: true}).fromTo($firstFood, 0.5, {opacity: 1}, {opacity: 0, ease: Expo.easeIn});
        //     var first_top;
        //     var first_bot;
        //     var first_mid;
        //     //only
        //     var $onlyFood = $('.only_food');
        //     var $onlyStick = $('.only_stick');
        //     //ingre_box
        //     var domImg = [$('.ingre .box1'), $('.ingre .box2'), $('.ingre .box3'), $('.ingre .box4'), $('.ingre .box5')];
        //     var domImg_top = [];
        //     var domImgGra_top = [];
        //     var domImg_bottom = [];
        //     var domImg_mid = [];
        //     var domImgGra_top_mid = [];
        //
        //     function setPosition(){
        //         scrollTop = win.scrollTop();
        //         winHeight = win.height();
        //         //brand_visual
        //         bv_play_top = winHeight/4;
        //         bv_stop_top = $brandVisual.height() - winHeight/2;
        //         //parallax
        //         $parallaxWrap.each(function(i){
        //             parallax_top[i] = $(this).offset().top - winHeight;
        //             parallax_bot[i] = $(this).offset().top + $(this).height();
        //             parallax_mid[i] = parallax_bot[i] - parallax_top[i];
        //             parallax_height[i] = $(this).height();
        //         });
        //         //first
        //         first_top = $firstBowl.offset().top - winHeight/4*3;
        //         first_bot = $firstBowl.offset().top - winHeight/4;
        //         first_mid = first_bot - first_top;
        //         //ingre_box
        //         for (var i = 0; i < domImg.length; i++) {
        //             if(domImg[i]){
        //                 domImg_top[i] = domImg[i].offset().top - winHeight;
        //                 domImgGra_top[i] = domImg[i].offset().top + domImg[i].data('height')/2 - winHeight;
        //                 domImg_bottom[i] = domImg[i].offset().top - winHeight/4;
        //                 domImg_mid[i] = domImg_bottom[i] - domImg_top[i];
        //                 domImgGra_top_mid[i] = domImg_bottom[i] - domImgGra_top[i];
        //                 TweenMax.set(domImg[i], {transformOrigin: 'center top'})
        //             }
        //         }
        //
        //         scrollHandler()
        //     }
        //     function scrollHandler(){
        //         scrollTop = win.scrollTop();
        //         //brand_visual
        //         if(video_played === true && scrollTop < bv_play_top){
        //             bv_vimeo.pause();
        //             video_played = false;
        //         }
        //         if(video_played === false && scrollTop >= bv_play_top && scrollTop < bv_stop_top){
        //             bv_vimeo.play();
        //             video_played = true;
        //         }
        //         if(video_played === true && scrollTop >= bv_stop_top){
        //             bv_vimeo.pause();
        //             video_played = false;
        //         }
        //         //parallax
        //         $parallaxWrap.each(function(i){
        //             progress = (scrollTop - parallax_top[i])/parallax_mid[i];
        //             var y = parallax_height[i]*0.3;
        //             progress = progress < 0 ? 0 : progress;
        //             progress = progress > 1 ? 1 : progress;
        //             TweenMax.set($(this).find('.parallax_bg'), {y: -y + (y*2*progress), ease: Power1.easeOut})
        //             if(i === 1){
        //                 TweenMax.set($onlyFood, {y: 100 - (100*progress)})
        //                 TweenMax.set($onlyStick, {y: 150 - (250*progress)})
        //             }
        //         });
        //
        //         progress1 = (scrollTop - first_top)/first_mid;
        //         progress1 = progress1 < 0 ? 0 : progress1;
        //         progress1 = progress1 > 1 ? 1 : progress1;
        //         firstFoodTl.progress(progress1)
        //         TweenMax.set($firstFood, {opacity: progress1});
        //         //ingre_box
        //         for (var i = 0; i < domImg.length; i++) {
        //             var progress = (scrollTop - domImg_top[i])/domImg_mid[i];
        //             progress = progress < 0 ? 0 : progress;
        //             progress = progress > 1 ? 1 : progress;
        //             TweenMax.set(domImg[i], {scale: 0.7 + (0.3*progress),opacity: 0.3 + (0.7*progress), ease: Power0.easeNone});
        //             var gra_progress = (scrollTop - domImgGra_top[i])/domImgGra_top_mid[i];
        //             gra_progress = gra_progress < 0 ? 0 : gra_progress;
        //             gra_progress = gra_progress > 1 ? 1 : gra_progress;
        //             TweenMax.set(domImg[i].find('.img_gra'), {y: -100*gra_progress+'%', ease: Power0.easeNone})
        //         }
        //     }
        //     win.scroll(scrollHandler).load(setPosition);
        //     win.resize(setPosition);
        // }());


        (function(){
            var $modBtn = '.mod_btn';
            var $logoWrap = $('.identity .logo_wrap')
            $('body').on('click', $modBtn, function(){
                var $this = $(this);
                if($this.hasClass('light')){
                    $this.removeClass('light').addClass('dark');
                    $logoWrap.removeClass('light').addClass('dark');
                }else if($this.hasClass('dark')){
                    $this.removeClass('dark').addClass('light');
                    $logoWrap.removeClass('dark').addClass('light');
                }
            })
        }());

        (function(){
            var $identityPaging_li = '.identity_paging li';
            var $identityPaging_a = '.identity_paging a';
            var $logo1 = $('.identity .logo1');
            var $logo2 = $('.identity .logo2');
            var $logo3 = $('.identity .logo3');
            var length = $($identityPaging_li).size();
            var tl = new TimelineMax({repeat: -1});
            tl.to('', 3, {onComplete: function(){
                changeOn();
            }});
            var click = false;

            function changeOn(){
                if(click == true){return false;}
                var $li = $($identityPaging_li+'.on').next().length == 0 ? $($identityPaging_li).eq(0) : $($identityPaging_li+'.on').next();
                var index = $li.index();
                $li.siblings('li').filter('.on').removeClass('on');
                $li.addClass('on');
                if(index === 0){
                    TweenMax.to($logo1, 0.5, {opacity:1});
                    TweenMax.to($logo2, 0.5, {opacity:0.3});
                    TweenMax.to($logo3, 0.5, {opacity:0.3});
                }else if(index === 1){
                    TweenMax.to($logo1, 0.5, {opacity:0.3});
                    TweenMax.to($logo2, 0.5, {opacity:1});
                    TweenMax.to($logo3, 0.5, {opacity:0.3});
                }else if(index === 2){
                    TweenMax.to($logo1, 0.5, {opacity:1});
                    TweenMax.to($logo2, 0.5, {opacity:1});
                    TweenMax.to($logo3, 0.5, {opacity:1});
                }
            }

            $('body').on('click', $identityPaging_a, function(){
                click = true;
                tl.pause();
                var $li = $(this).parent('li');
                var index = $li.index();
                $li.siblings('li').filter('.on').removeClass('on');
                $li.addClass('on');
                if(index === 0){
                    TweenMax.to($logo1, 0.5, {opacity:1});
                    TweenMax.to($logo2, 0.5, {opacity:0.3});
                    TweenMax.to($logo3, 0.5, {opacity:0.3});
                }else if(index === 1){
                    TweenMax.to($logo1, 0.5, {opacity:0.3});
                    TweenMax.to($logo2, 0.5, {opacity:1});
                    TweenMax.to($logo3, 0.5, {opacity:0.3});
                }else if(index === 2){
                    TweenMax.to($logo1, 0.5, {opacity:1});
                    TweenMax.to($logo2, 0.5, {opacity:1});
                    TweenMax.to($logo3, 0.5, {opacity:1});
                }
                $($identityPaging_a).on('mouseleave', function(){
                    click = false;
                    tl.progress(0);
                    tl.play();
                    $($identityPaging_a).off('mouseleave');
                });
            });


            $($identityPaging_li+'.on a').trigger('click');
            $($identityPaging_li+'.on a').trigger('mouseleave');
        }());

        (function(){
            var $delicate_bg1 = $('.delicate_bg1');
            var $delicate_bg2 = $('.delicate_bg2');
            var delicateTl = new TimelineMax({repeat: -1});
            delicateTl.set($delicate_bg2, {x: '50%', opacity: 0});
            delicateTl.add([
                TweenMax.set($delicate_bg1, {zIndex: 1}),
                TweenMax.set($delicate_bg2, {zIndex: 2}),
                TweenMax.to($delicate_bg1, 0.5, {x: '50%', opacity: 0}),
                TweenMax.to($delicate_bg2, 1, {x: '0%', opacity: 1})
            ], '+=3');
            delicateTl.add([
                TweenMax.set($delicate_bg1, {zIndex: 2}),
                TweenMax.set($delicate_bg2, {zIndex: 1}),
                TweenMax.to($delicate_bg1, 1, {x: '0%', opacity: 1}),
                TweenMax.to($delicate_bg2, 0.5, {x: '50%', opacity: 0})
            ], '+=3');
        }());


        // var side_Motion;
        // (function(){
        //     var $sideLayer = $('.side_layer');
        //     var $clipWrap = $('.clip_wrap');
        //     var r_top = 0;
        //     var r_bottom = $clipWrap.height();
        //     var r_left = 0;
        //     var r_right = $clipWrap.width();
        //     var tl_played = false;
        //     TweenMax.set($sideLayer, {height: r_bottom});
        //     TweenMax.set($clipWrap, {clip: 'rect(0,0,'+r_bottom+'px,0)'});
        //     side_Motion = new TimelineMax({paused: true}).to($clipWrap, 1, {clip: 'rect(0,'+r_right+'px,'+r_bottom+'px,0)', onStart: function(){
        //         tl_played = true;
        //     }});
        //     win.resize(function(){
        //         r_bottom = $clipWrap.height();
        //         r_right = $clipWrap.width();
        //         TweenMax.set($sideLayer, {height: r_bottom});
        //         if(tl_played){
        //             TweenMax.set($clipWrap, {clip: 'rect(0,'+$clipWrap.width()+'px,'+$clipWrap.height()+'px,0)'});
        //         }else{
        //             TweenMax.set($clipWrap, {clip: 'rect(0,0,'+$clipWrap.height()+'px,0)'});
        //             side_Motion = new TimelineMax({paused: true}).to($clipWrap, 1, {clip: 'rect(0,'+r_right+'px,'+r_bottom+'px,0)', onStart: function(){
        //                 tl_played = true;
        //             }});
        //         }
        //     })
        // }())
        // new YMotion([
        //     [
        //         {method: 'call', fx: function() {
        //             side_Motion.play();
        //         }},
    	// 	],
    	// ]).activate();

    });
}(jQuery));
