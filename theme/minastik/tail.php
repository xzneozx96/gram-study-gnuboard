<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}
?>

    </div>
</div>

</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="footer--left">
                    <!-- <img src="/images/minastik-full-ver.png" width="150px" alt="full-ver"> -->
                    <img src="<?=G5_THEME_URL?>/img/minastik/minastik-full-ver.png" width="150px" alt="logo">

                    <ul class="short_links">
                        <li><a href="https://minastik.com/#about">Giới thiệu</a></li>
                        <li><a href="https://minastik.com/#services">Dịch vụ</a></li>
                        <li><a href="https://minastik.com/#process">Quy trình</a></li>
                        <li><a href="#portfolio">Dự án</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-5">
                <div class="footer--right">
                    <ul class="social_links">
                        <li><a rel="noreferrer" target="_blank" href="https://www.facebook.com/minastikVN"><i class='bx bxl-facebook'></i></a>
                        </li>
                        <li><a rel="noreferrer" target="_blank" href="https://web.whatsapp.com/"><i class='bx bxl-whatsapp'></i></a></li>
                        <li><a rel="noreferrer" target="_blank" href="https://www.tiktok.com/@life_at_minastik"><i class='bx bxl-tiktok'></i></a></li>
                    </ul>
                    <span>© 2021 Minastik. All Rights Reserved.
                    </span>
                </div>
            </div>
        </div>
    </div>
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

<?php
include_once(G5_THEME_PATH."/tail.sub.php");