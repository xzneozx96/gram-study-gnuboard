<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
		<?php if($bo_table ) : ?>
                </div>
        <?php endif;?>
    </div>
</div>
<!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<div class="footer">

    <div class="container">
    	<div class="footer_info">
            <div class="footer_link">
            	<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="provision">개인정보처리방침</a>
                
            </div>
            <div class="footer_copy">
                <p>
                그램 스터디카페     대표자 : 서태영     TEL : 1577-5409     FAX : 0504-346-4602     E-mail : yy051186@naver.com<br />
                사업자등록번호 : 191-15-01162     주소  :  경남 창원시 성산구 창원천로 294 2층 그램스터디카페 반지점
                </p>
                <br />Copyright   2021 DAON Syudy cafe  All Rights Reserved.
            </div>
        </div>
        <div class="footer_logo"><img src="<?=G5_THEME_IMG_URL?>/ft_logo.png" /></div>
    </div>
    
    <div class="inquire_btn"><a href="/bri/sub.php?sub=sub_40&menu=10#frc_inquire">가맹<br />문의하기<br /><span>Go</span></a></div>
    <button type="button" id="top_btn" onclick="window.location.href='#top'"><i class="xi-long-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
	<script>
    
    $(function() {
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
    </script>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>



<!-- } 하단 끝 -->



<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>
<script>
	AOS.init({
		duration: 1200,
	});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>