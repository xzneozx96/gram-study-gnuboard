<?php
// define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div class="main_img">
	<div class="m_tlt" >
        <p class="mtop_t1" data-aos="fade-up" data-aos-delay="100">GRAM STUDY CAFE</p>
        <h1 class="" data-aos="fade-up" data-aos-delay="300">질량보존의 법칙,<br /><strong>노력한 만큼 반드시 <span class="tablet_block mobile_block">그 가치는 반영된다.</span></strong></h1>
        <p class="mtop_t2" data-aos="fade-up" data-aos-delay="500"><span>그램 스터디카페는 꿈을 가진 사람들의 <span class="mobile_block">사랑을 받으며 교육문화를 선도하는 기업으로</span></span><span class="mobile_block">언제나 여러분과 함께 성장하는</span> 그램 스터디카페가 되도록 최선을 다하겠습니다.</p>
    </div>
    <div class="scroll_down">
    	<div><img src="<?=G5_THEME_IMG_URL?>/scroll_down.png" /></div>
        scroll<br />down
    </div>
    <div class="bg type-b"></div>
</div>


<div class="lyr_03">
    <div class="lyr3_wrap over_h clearfix w100 h100">
        <div class="half_box box1">
            <div class="lyr3_left_slide">
                <div class="swiper-container swiper-container-horizontal">
                    <ul class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                        <li class="swiper-slide swiper-slide-active" style="width: 453px !important;">
                            <img src="<?=G5_THEME_IMG_URL?>/m_gspace_img1.jpg" class="img-fluid" alt="">
                        </li>
                        <li class="swiper-slide swiper-slide-next" style="width:453px;">
                            <img src="<?=G5_THEME_IMG_URL?>/m_gspace_img2.jpg" class="img-fluid" alt="">
                        </li>
                        <li class="swiper-slide" style="width: 453px;">
                            <img src="<?=G5_THEME_IMG_URL?>/m_gspace_img3.jpg" class="img-fluid" alt="">
                        </li>
                    </ul>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                <p class="lyr3_left_letter1 abs">GRAM STUDY CAFE</p>
                <p class="lyr3_left_letter2 abs t_right">
                    <span class="row1">공</span>
                    <span class="row2">간.</span>
                </p>
            </div>
        </div>
        <div class="half_box box2">
            <div class="over_h box_inner">
                <p class="lyr3_title" data-aos="fade-up" data-aos-delay="100">
                    집중력 향상을 위한<br>
                    <em>그램의 완벽한 공간</em>
                    <a href="/bri/sub.php?sub=sub_20&menu=10" class="sl_link">공간소개 +</a>
                </p>
                <div class="lyr3_right_slide">
                    
                    <div class="swiper-container swiper-container-horizontal">
                        <ul class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                            <li class="swiper-slide swiper-slide-active">
                                <p class="sl_title">정확한 설계와 <br><span>감각적인 인테리어</span></p>
                                <p class="sl_text text">
                                	<span>스터디 공간을 위해 좌석간의 간격, 통로간격,</span>
                                    <span>책상의 너비와 높이, 편안한 조명 등을</span>
                                    <span>맞춤제작하여 소비자에게 진정성있는</span>
                                    <span>새로운 스터디카페를 선도합니다.</span>
                                </p>
                                <!-- <a href="/html/business.html#3" class="sl_link">자세히보기</a> -->
                            </li>
                            <li class="swiper-slide swiper-slide-next" >
                                <p class="sl_title">책상·조명 등<br><span>그램의 무드 디테일</span></p>
                                <p class="sl_text text">
                                    <span>학습 시 낮고 무거운 분위기의 공간과</span>
                                    <span>좌석마다 개인조명을 설치하여</span>
                                    <span>오랫동안 책을 봐야하는 눈의 피로감을</span>
                                    <span>최소화 시키고 집중력을 향상시켰습니다.</span>
                                </p>
                                <!-- <a href="/html/business.html#2" class="sl_link">자세히보기</a> -->
                            </li>
                            <li class="swiper-slide" >
                                <p class="sl_title">차별화 된 환경조성<br><span>국내 최상위급 가구</span></p>
                                <p class="sl_text text">
                                    <span>스터디존에는 피톤치드를 의무화하여</span>
                                    <span>집중력 향상과 피로도 감소에 집중하였으며</span>
                                    <span>국내 최상위급 목수들이 현장에서</span>
                                    <span>직접 책상을 맞춤제작합니다.</span>
                                </p>
                            </li>
                        </ul>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                    <div class="slide_bot">
                        <div class="lyr3_btns fs_def">
                            <button type="button" class="swiper-button-prev lyr3_btn lyr3_prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true">이전</button>
                            <span></span>
                            <button type="button" class="swiper-button-next lyr3_btn lyr3_next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">다음</button>
                        </div>
                        <div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-progressbar-opposite"><span class="swiper-pagination-progressbar-fill" style="transform: translate3d(0px, 0px, 0px) scaleX(0.333333) scaleY(1); transition-duration: 300ms;"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="lyr_04">
    <div class="lyr4_wrap clearfix h100">
        
        
        
        <div class="half_box box2">
            <div class="lyr4_right_slide over_h">
                <div class="swiper-container">
                    <ul class="swiper-wrapper">
                        <li class="swiper-slide">
                            <img src="<?=G5_THEME_IMG_URL?>/m_founding_img1.jpg" class="img-fluid" alt="">
                        </li>
                        <li class="swiper-slide">
                            <img src="<?=G5_THEME_IMG_URL?>/m_founding_img2.jpg" class="img-fluid" alt="">
                        </li>
                        <li class="swiper-slide">
                            <img src="<?=G5_THEME_IMG_URL?>/m_founding_img3.jpg" class="img-fluid" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="half_box box1">
            <div class="box_inner rel">

                <div class="lyr4_title" data-aos="fade-up" data-aos-delay="100">
                    업계최고 본사지원<br>
                    <em>로열티·가맹비 0%</em>
                    <div>
                        <a href="/bri/sub.php?sub=sub_40&menu=10" class="sl_link">가맹안내   +</a>
                        <a href="/bri/sub.php?sub=sub_40&menu=10#frc_inquire" class="sl_link inquire">가맹문의   +</a>
                    </div>
                </div>


                <div class="lyr4_left_slide">
                <div class="swiper-container swiper-container-horizontal">
                    <ul class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                        <li class="swiper-slide swiper-slide-active" style="width:412px !important;">
                            <p class="sl_title"><span class="img"><img src="<?=G5_THEME_IMG_URL?>/mfrc_icon1.jpg" /></span>맞춤형 소자본<span>안전한 창업</span></p>
                            <p class="sl_text text">
                                <span>가맹점의 부담을 덜어드리기 위해 본사지원을</span>
                                <span>최대한으로 확장하여 그램스터디카페는</span>
                                <span>로열티·가맹비를 과감하게 없앴습니다.</span>
                            </p>
                            <!-- <a href="/html/business.html#3" class="sl_link">자세히보기</a> -->
                        </li>
                        <li class="swiper-slide swiper-slide-next" style="width: 412px;">
                            <p class="sl_title"><span class="img"><img src="<?=G5_THEME_IMG_URL?>/mfrc_icon2.jpg" /></span>철저한 사후관리<span>격이다른 그램서비스</span></p>
                            <p class="sl_text text">
                                <span>스터디 카페는 교육열을 반영한 장기사업으로</span>
                                <span>탄탄한 상권분석이 반드시 필요합니다.</span>
                                <span>그램에서 체계적으로 갖춰드리겠습니다.</span>
                            </p>
                            <!-- <a href="/html/business.html#2" class="sl_link">자세히보기</a> -->
                        </li>
                        <li class="swiper-slide" style="width: 412px;">
                            <p class="sl_title"><span class="img"><img src="<?=G5_THEME_IMG_URL?>/mfrc_icon3.jpg" /></span>쉽고 간편한<br><span>운영을 위해 차별화 된</span></p>
                            <p class="sl_text text">
                                <span>무인 시스템을 구현하여 경험없는 초보자도</span>
                                <span>쉽게 운영할 수 있는 시스템을 제공합니다.</span>
                            </p>
                        </li>
                    </ul>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="swiper-pagination swiper-pagination-white gr-pagination"></div>
                </div>
                
                
                <!--<div class="swiper-pagination swiper-pagination-progressbar">
                    <span class="swiper-pagination-progressbar-fill"></span>
                </div>-->
            </div>
        </div>
        

        
    </div>
</div>

<div class="m_gr_04">
	<div>
        <p data-aos="fade-up" data-aos-delay="100">
            NO.1 스터디카페 브랜드
            <span>그램 스터디카페, <span class="mobile_block">공생을 이야기하다</span></span>
        </p>
        <a href="/bri/sub.php?sub=sub_10&menu=10"  data-aos="fade-up" data-aos-delay="300">그램소개 +</a>
        <a href="/bri/sub.php?sub=sub_10&menu=10#location"  data-aos="fade-up" data-aos-delay="500">오시는 길 +</a>
    </div>
</div>

<div class="m_gr_board">
	<div class="container">
        <div class="board-cts"  data-aos="fade-up" data-aos-delay="100">
            <h1>공지사항<a href="/bri/board.php?bo_table=notice">more<i class="xi-long-arrow-right"></i></a></h1>
            <?php
			echo latest('theme/basic', 'notice', 2, 65);
			?>
            
            <!--<p><span class="mark"><img src="<?=G5_THEME_IMG_URL?>/t_mark.jpg" /></span><a href="#;">공지사항내용 표기</a><span class="date">21-02-02</span></p>
            <p><span class="mark"><img src="<?=G5_THEME_IMG_URL?>/t_mark.jpg" /></span><a href="#;">공지사항내용 표기</a><span class="date">21-02-02</span></p>-->
        </div>
        <div class="board-cts"  data-aos="fade-up" data-aos-delay="300">
            <h1>FAQ<a href="/bri/board.php?bo_table=faq">more<i class="xi-long-arrow-right"></i></a></h1>
            <?php
			echo latest('theme/faq', 'faq', 2, 65);
			?>
            <!--<p><span class="mark"><img src="<?=G5_THEME_IMG_URL?>/t_mark.jpg" /></span><a href="#;">공지사항내용 표기</a><span class="date">21-02-02</span></p>
            <p><span class="mark"><img src="<?=G5_THEME_IMG_URL?>/t_mark.jpg" /></span><a href="#;">공지사항내용 표기</a><span class="date">21-02-02</span></p>-->
        </div>
    </div>
</div>




<?php
include_once(G5_THEME_PATH.'/tail.php');
?>