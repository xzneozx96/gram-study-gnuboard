<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
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
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>


    <header class="header">
        <div class="container">
            <div class="logo"><a href="<?=G5_URL?>"></a></div>
            <div id='cssmenu' class="menu">
                <ul>
                    <li class='active'><a href='javascript:void(0)' class="submenu-btn">그램소개</a>
                        <ul>
                            <li><a href='/bri/sub.php?sub=sub_10&menu=10'>그램소개</a></li>
                            <li><a href='/bri/sub.php?sub=sub_10&menu=10#ceo_message'>CEO 인사말</a></li>
                            <li><a href='/bri/sub.php?sub=sub_10&menu=10#location'>오시는 길</a></li>
                        </ul>
                    </li>
                    <li><a href='#;' class="submenu-btn">공간소개</a>
                        <ul>
                            <li><a href='/bri/sub.php?sub=sub_20&menu=10'>공간소개</a></li>
                        </ul>
                    </li>
                    <li><a href='#;' class="submenu-btn">지점찾기</a>
                        <ul>
                            <li><a href='/bri/board.php?bo_table=branches'>지점찾기</a></li>
                        </ul>
                    </li>
                    <li><a href='#;' class="submenu-btn">가맹문의</a>
                        <ul>
                            <li><a href='/bri/sub.php?sub=sub_40&menu=10'>가맹안내</a></li>
                            <li><a href='/bri/sub.php?sub=sub_40&menu=10#frc_inquire'>가맹문의</a></li>
                        </ul>
                    </li>
                    <li><a href='#;' class="submenu-btn">공지사항</a>
                        <ul>
                            <li><a href='/bri/board.php?bo_table=notice'>공지사항</a></li>
                            <li><a href='/bri/board.php?bo_table=faq'>FAQ</a></li>
                        </ul>
                    </li>
                    <?php if($is_admin) { ?>
                        <li><a href='/bri/logout.php' class="submenu-btn" style="font-size: 14px;">LOGOUT</a></li>
                    <?php }else { ?>
                        <li><a href='/adm' class="submenu-btn" style="font-size: 14px;">ADMIN</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

    </header>

    <script>
        $(function(){
            $(window).scroll(function(){  //스크롤하면 아래 코드 실행
                var num = $(this).scrollTop();  // 스크롤값
                if( num > 36 ){  // 스크롤을 36이상 했을 때
                    $('.header').addClass('scroll-fixed');
                }else{
                    $('.header').removeClass('scroll-fixed');
                }
            });
        });
    </script>
</div>
<!-- } 상단 끝 -->

<!-- 콘텐츠 시작 { -->
<div>


    <div class="">
        <?php if($bo_table ) : ?>

        <?php if($bo_table == 'branches') { ?>
            <div class="sub_top">
                <div class="m_tlt">
                    <p class="title" data-aos="fade-down" data-aos-delay="100"><?php echo get_head_title($g5['title']); ?></p>
                    <p class="tl_txt" data-aos="fade-down" data-aos-delay="300">이용요금 및 좌석확인은 <span class="mobile_block">해당 지점으로 문의바랍니다.</span></p>

                </div>

                <div class="bg image2 type-b"></div>

            </div>
        <?php } else { ?>
            <p class="board_title" data-aos="fade-down" data-aos-delay="100"><?php echo get_head_title($g5['title']); ?></p>
        <?php } ?>



        <div class="container board_container">

            <?php endif;?>

