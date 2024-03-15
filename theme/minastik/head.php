<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$menu_datas = sql_query(" select * from {$g5['menu_table']} where length(me_code) = 2 and me_use = 1 order by me_code ");

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

?>

<!-- 상단 시작 { -->
<div>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <header class="header_area">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container custom_container p0">
                <a class="navbar-brand" href="<?php echo G5_URL ?>">
                    <img src="<?=G5_THEME_URL?>/img/minastik/minastik-full-ver.png" width="100px" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" onclick="showMobileMenu()">
                    <span class="menu_toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto menu">
                        <?php 
                            $delay = 200; // Initialize delay variable
                            foreach ($menu_datas as $index => $field): // Iterate over menu_datas array with index
                                $sql2 = "SELECT * FROM {$g5['menu_table']} WHERE LENGTH(me_code) = 4 AND LEFT(me_code, 2) = '" . $field["me_code"] . "' AND me_use = 1 ORDER BY me_code";

                                $menu_submenus = sql_query($sql2);
                        ?>
                        
                        <li class="nav-item dropdown submenu mega_menu">
                            <a class="custom-nav-link" href="<?= $field['me_link']; ?>" target="<?= $field['me_target']; ?>">
                                    <?= $field['me_name'] ?>
                            </a>

                            <?php if ($menu_submenus->num_rows > 0): ?>
                                <ul class="sub-menu">
                                    <?php 
                                            foreach ($menu_submenus as $field2): // Iterate over menu_submenus array
                                    ?>
                                        <li class="nav-item dropdown mega_menu">
                                            <a class="custom-nav-link" href="<?= $field2['me_link']; ?>" target="<?= $field2['me_target']; ?>">
                                                    <?= $field2['me_name'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        
                        <?php
                            $delay += 200; // Increment delay by 200 milliseconds for each iteration
                            endforeach; 
                        ?>
                    </ul>

                    <a class="btn_contact btn_hover" href="/#contact">Liên hệ</a>
                </div>
            </div>
        </nav>

        <!-- mobile menu -->
        <nav class="side_menu--wrap d-lg-none">
            <div class="side_menu--main">
                <i class='bx bx-x' onclick="hideMobileMenu()"></i>

                <div class="side_links">
                    <ul class="navbar-nav mobile_menu menu">
                        <?php 
                            $delay = 200; // Initialize delay variable
                            foreach ($menu_datas as $index => $field): // Iterate over menu_datas array with index
                                $sql2 = "SELECT * FROM {$g5['menu_table']} WHERE LENGTH(me_code) = 4 AND LEFT(me_code, 2) = '" . $field["me_code"] . "' AND me_use = 1 ORDER BY me_code";

                                $menu_submenus = sql_query($sql2);
                        ?>
                        
                        <li class="nav-item dropdown submenu mega_menu" onclick="hideMobileMenu()">
                            <a class="custom-nav-link" href="<?= $field['me_link']; ?>" target="_self">
                                    <?= $field['me_name'] ?>
                            </a>

                            <?php if ($menu_submenus->num_rows > 0): ?>
                                <ul class="sub-menu">
                                    <?php 
                                            foreach ($menu_submenus as $field2): // Iterate over menu_submenus array
                                    ?>
                                        <li class="nav-item dropdown mega_menu">
                                            <a class="custom-nav-link" href="<?= $field2['me_link']; ?>" target="<?= $field2['me_target']; ?>">
                                                    <?= $field2['me_name'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        
                        <?php
                            $delay += 200; // Increment delay by 200 milliseconds for each iteration
                            endforeach; 
                        ?>
                    </ul>

                    <div class="side_menu_cta">
                        <span>Bạn có ý tưởng ?</span>
                        <button class="btn mobile_cta_btn" onclick="hideMobileMenu()">
                            <span><a target="_self" href="/#contact">Liên hệ ngay</a></span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>

                    <ul class="side_menu_social_links">
                        <li><a rel="noreferrer" target="_blank" href="https://www.facebook.com/minastikVN"><i class='bx bxl-facebook'></i></a></li>
                        <li><a rel="noreferrer" target="_blank" href="https://web.whatsapp.com/"><i class='bx bxl-whatsapp'></i></a></li>
                        <li><a rel="noreferrer" target="_blank" href="https://www.tiktok.com/@life_at_minastik"><i class='bx bxl-tiktok'></i></a></li>
                    </ul>
                    <span>© 2021 Minastik. All Rights Reserved.</span>
                </div>
            </div>
        </nav>
    </header>
</div>