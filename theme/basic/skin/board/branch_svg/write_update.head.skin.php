<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*
$wr_1 = '';
if (isset($_POST['wr_1'])) {
    $wr_1 = substr(trim($_POST['wr_1']),0,255);
    $wr_1 = preg_replace("#[\\\]+$#", "", $wr_1);
}

strip_tags
*/

$wr_1 = addslashes(clean_xss_tags($_POST['wr_1']));
$wr_2 = addslashes(clean_xss_tags($_POST['wr_2']));
?>
