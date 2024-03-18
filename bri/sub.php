<?php
include_once('./_common.php');

$sub = $_GET['sub'];
$menu= $_GET['menu'];

$sub_url = G5_THEME_URL."/skin/sub/".$sub;

//sub메뉴가 존재하는지 체크
$is_dir_exist = is_dir(G5_THEME_PATH.'/skin/sub/'.$sub);
$is_file_exist = is_file(G5_THEME_PATH.'/skin/sub/'.$sub.'/menu'.$menu.'.skin.php');

if (!$is_dir_exist || !$is_file_exist) {
    alert("존재하지 않는 경로입니다.");
}

include_once(G5_THEME_PATH.'/head.php');

include_once(G5_THEME_PATH.'/skin/sub/'.$sub.'/menu.head.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$sub_url.'/style.css?var='.G5_CSS_VER.'">', 0);

include_once(G5_THEME_PATH.'/skin/sub/'.$sub.'/menu'.$menu.'.skin.php');

include_once(G5_THEME_PATH."/tail.php");
?>
